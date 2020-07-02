<?php

namespace App\Console\Commands;

use App\Models\File;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Regex\Regex;
use Symfony\Component\CssSelector\CssSelectorConverter;
use Symfony\Component\DomCrawler\Crawler;

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
            $fileContents = $httpClient->get($url)->getBody()->getContents();

            $publishedAt = Carbon::createFromFormat(
                'd.m.Y',
                Regex::match('/([123]0|[012][1-9]|31).(0[1-9]|1[012]).(19[0-9]{2}|2[0-9]{3})$/', $text)->result()
            );


            $originalFilename = basename($url);

            Storage::disk('local')->put('files/' . $originalFilename, $fileContents);

            $this->line('SAVED');
        });
    }
}
