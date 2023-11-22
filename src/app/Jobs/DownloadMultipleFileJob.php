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

class DownloadMultipleFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $ids;

    protected int $userId;

    protected string $pathZip;

    /**
     * Create a new job instance.
     */
    public function __construct(array $ids, int $userId, string $pathZip)
    {
        $this->ids = $ids;
        $this->userId = $userId;
        $this->pathZip = $pathZip;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $zip = new ZipArchive();
            $pathZip = $this->pathZip;
            $files =  [];
            $filePathParent = null;
            foreach ($this->ids as $id){
                $fileManager = FileManager::find($id);
                if (empty($filePathParent)){
                    $filePathParent = $fileManager->parent->file_path;
                }
                $path = $fileManager->file_path;
                if (!empty($fileManager->file_type)){
                    $files[] = [$path];
                }else{
                   $files[] = $fileManager->getPathFileIsTrash($fileManager,$this->userId);
                }
            }
            $files = array_merge(...array_filter($files));

            if ($zip->open($pathZip, ZipArchive::CREATE) === true) {
                foreach ($files as $file) {
                    $zip->addFile(storage_path('app/'.$file), str_replace($filePathParent.'/', '', $file));
                }
            }
        } catch (\Exception $exception) {
            Log::error(class_basename($this).': '.$exception->getMessage());
        }
    }
}
