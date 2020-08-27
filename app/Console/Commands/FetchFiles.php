<?php

namespace App\Console\Commands;

use App\Mail\FileFetched;
use App\Models\File;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\Regex\Regex;
use Symfony\Component\CssSelector\CssSelectorConverter;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\File as LaravelFile;

class FetchFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all files and store new ones';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $crawlerBaseUrl = env('CRAWLER_BASE_URL');

        $httpClient = new Client();
        $responseContent = $httpClient->get($crawlerBaseUrl)->getBody()->getContents();

        $cssSelectorConverter = new CssSelectorConverter();
        $crawler = new Crawler($responseContent);
        $links = $crawler->filterXPath($cssSelectorConverter->toXPath('.col-md-6 li > a'));

        $links->each(function (Crawler $node) use ($httpClient) {
            $text = $node->text();
            $url = $node->attr('href');

            $originalFilename = basename($url);

            File::whereOriginalFilename($originalFilename)->firstOr(function () use ($httpClient, $url, $text, $originalFilename) {
                $fileContents = $httpClient->get($url)->getBody()->getContents();

                $no = Regex::match('/([1-9]|[1-9][0-9])\d+/', Regex::match('/Ausgabe Nr. ([1-9]|[1-9][0-9])\d+/', $text)->result())->result();
                $publishedAt = Carbon::createFromFormat(
                    'd.m.Y',
                    Regex::match('/([123]0|[012][1-9]|31)\.(0[1-9]|1[012])\.(19[0-9]{2}|2[0-9]{3})/', $text)->result()
                );
                $extension = LaravelFile::extension("files/{$originalFilename}");

                $file = new File();
                $file->no = $no;
                $file->original_filename = $originalFilename;
                $file->mimetype = '/';
                $file->extension = $extension;
                $file->size = 0;

                $file->save();

                $filePath = "files/{$file->id}.{$extension}";

                Storage::disk('local')->put($filePath, $fileContents);

                $mimetype = Storage::disk('local')->mimeType($filePath);
                $size = Storage::disk('local')->size($filePath);

                $file->mimetype = $mimetype;
                $file->size = $size;
                $file->published_at = $publishedAt;

                $file->save();

                // Send notification mails
                User::all()->pluck('email')->each(function ($email) use ($file) {
                    Mail::to($email)->send(new FileFetched($file));

                    $this->line("Sent mail to {$email}");
                });

                $this->line("File #{$no} {$publishedAt->toDateString()} saved.");
            });
        });
    }
}
