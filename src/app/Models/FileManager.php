<?php

namespace Ntlong050801\FileManager\app\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class FileManager extends Model
{
    protected $table = 'file_manager';

    protected $fillable = [
        'name',
        'file_path',
        'file_type',
        'file_size',
        'parent_id',
        'user_id',
        'is_trash',
        'is_direct_deleted',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(FileManager::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(FileManager::class, 'parent_id');
    }

    public static function root(){
        return FileManager::whereNull('parent_id')->where('parent_id',auth()->id())->first();
    }

    protected function fileSize(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->formatFileSize($value),
        );
    }

//    protected function filePath(): Attribute
//    {
//        return Attribute::make(
//            get: fn ($value) => 'app/'.$value,
//        );
//    }

    private function formatFileSize($bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        return round($bytes, 2) . ' ' . $units[$pow];
    }

    public function childFiles($filePath): array
    {
        $files = Storage::files($filePath);
        $childDirectories = Storage::directories($filePath);
        foreach ($childDirectories as $childDirectory) {
            $files = array_merge($files,$this->childFiles($childDirectory));
        }
        return $files;
    }

}
