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
use Ntlong050801\FileManager\app\Models\User;
use ZipArchive;

class DownloadFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected FileManager $fileManager;

    protected bool $isTrash, $isShare;

    protected int $userId;

    /**
     * Create a new job instance.
     */
    public function __construct(FileManager $fileManager, int $userId, bool $isTrash = false, bool $isShare = false, )
    {
        $this->fileManager = $fileManager;
        $this->userId = $userId;
        $this->isTrash = $isTrash;
        $this->isShare = $isShare;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $path = $this->fileManager->file_path;
            $zip = new ZipArchive();

            $files = $this->fileManager->getPathFileIsTrash($this->fileManager,$this->userId, $this->isTrash, $this->isShare);

            $pathZip = storage_path('app/'.$this->fileManager->name.'.zip');
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
