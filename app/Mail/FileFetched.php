<?php

namespace App\Mail;

use App\Models\File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FileFetched extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var File
     */
    private $file;

    /**
     * Create a new message instance.
     *
     * @param File $file
     * @return void
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.files.fetched', ['file' => $this->file])
            ->subject('Neues Amtsblatt verfügbar')
            ->attachFromStorageDisk('local', "files/{$this->file->id}.{$this->file->extension}");
    }
}
