<?php

namespace Ntlong050801\FileManager\app\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Ntlong050801\FileManager\app\Models\FileManager;
use ZipArchive;

class DownloadFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected FileManager $fileManager;

    /**
     * Create a new job instance.
     */
    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $path = $this->fileManager->file_path;
            $zip = new ZipArchive();
            $files = $this->fileManager->childFiles($path);
            $pathZip = storage_path('app/'. $this->fileManager->name.'.zip');
            if ($zip->open($pathZip, ZipArchive::CREATE) === true) {
                foreach ($files as $file) {
                    $zip->addFile(storage_path('app/'.$file), str_replace($path.'/', '', $file));
                }
            }
        } catch (\Exception $exception) {
            Log::error(class_basename($this).': '.$exception->getMessage());
        }
    }
}
