<?php

namespace Ntlong050801\FileManager\app\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Ntlong050801\FileManager\app\Jobs\DownloadFileJob;
use Ntlong050801\FileManager\app\Jobs\DownloadMultipleFileJob;
use Ntlong050801\FileManager\app\Models\FileManager;
use Ntlong050801\FileManager\app\Models\User;

class FileManagerController extends Controller
{
    public function index(){
        $parent = FileManager::where('user_id',auth()->id())->first();
        return view('file-manager::pages.file-manager.index',compact('parent'));
    }

    public function downloadFile(Request $request)
    {
        $privateFileId = User::find(auth()->id())->file->pluck('id')->toArray();
        $user = User::find(auth()->id())->files->pluck('id')->toArray();
        $request->validate([
            'id' => ['required', 'integer', Rule::in(array_merge($privateFileId, $user))],
            'type' => ['required', Rule::in(FileManager::LIST_TYPE_FOLDER)],
        ]);
        $file = FileManager::findOrFail($request->input('id'));
        $path = $file->file_path;
        $type = $request->input('type');
        $userId = auth()->id();
        $isTrash = $type === FileManager::TYPE_DELETE_FOLDER;
        $isShare = $type === FileManager::TYPE_SHARE_FOLDER;
        if (Storage::exists($path)) {
            if (empty($file->file_type)) {
                $pathZip = storage_path('app/File-manager/'.$file->name.'.zip');
                if (Storage::exists($pathZip)) {
                    Storage::delete($pathZip);
                }
                DownloadFileJob::dispatch($file, $userId, $isTrash, $isShare)->delay(now()->addSeconds(30));

                return response()->download($pathZip)->deleteFileAfterSend();
            } else {
                if ($isShare) {
                    if (in_array($userId, $file->users->pluck('pivot.user_id')->toArray())) {
                        return response()->download(storage_path('app/'.$path));
                    }
                    abort('403', 'NOT PERMISSION');
                }
                return response()->download(storage_path('app/'.$path));
            }
        } else {
            abort('404');
        }
    }

    public function downloadMultipleFile(Request $request)
    {
        $request->validate([
            'ids' => ['required'],
        ]);
        $ids = explode('-', $request->input('ids'));
        try {
            Validator::make(['ids' => $ids], [
                'ids' => ['required', 'array'],
                'ids.*' => ['integer', Rule::in(User::find(auth()->id())->file->pluck('id')->toArray())],
            ]);
            $fileParent = FileManager::find($ids[0])->parent;
            $pathZip = storage_path('app/File-manager/'.$fileParent->name.'.zip');
            if (Storage::exists($pathZip)) {
                Storage::delete($pathZip);
            }
            DownloadMultipleFileJob::dispatch($ids, auth()->id(), $pathZip);
            return response()->download($pathZip)->deleteFileAfterSend();

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function preview(Request $request)
    {
        $privateFileId = User::find(auth()->id())->file->pluck('id')->toArray();
        $shareFileId = User::find(auth()->id())->files->pluck('id')->toArray();
        $request->validate([
            'id' => ['required', 'integer', Rule::in(array_merge($privateFileId,$shareFileId))]
        ]);
        $file = FileManager::find($request->input('id'));
        $filePath = storage_path('app/'.$file->file_path);
        $type = $file->file_type;
        if (file_exists($filePath) && $type === 'pdf') {
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $file->original_filename . '"',
            ];
            return response()->file($filePath, $headers);
        } else {
            // If the file doesn't exist, return a 404 response or handle it accordingly
            return response()->json(['error' => 'File not found'], 404);
        }
    }

    public function showImageFromStorage(string $pathFile){
        $fullPath = storage_path('app/'.$pathFile);
        if (!File::exists($fullPath)) {
            return null;
        }
        $file = File::get($fullPath);
        $type = File::mimeType($fullPath);

        $response = Response::make($file);
        $response->header("Content-Type", $type);
        return $response;
    }
}
