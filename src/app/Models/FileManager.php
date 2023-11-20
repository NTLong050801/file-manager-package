<?php

namespace Ntlong050801\FileManager\app\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
    const TYPE_ALL_FOLDER= 'all-folder';
    const TYPE_DELETE_FOLDER = 'deleted-folder';
    const TYPE_PRIVATE_FOLDER = 'private-folder';
    const TYPE_SHARE_FOLDER = 'share-folder';
    const LIST_TYPE_FOLDER = [self::TYPE_ALL_FOLDER,self::TYPE_DELETE_FOLDER,self::TYPE_PRIVATE_FOLDER,self::TYPE_SHARE_FOLDER];
    public array $arrayFilePath = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'file_user', 'file_id', 'user_id')->withPivot('is_click_permission');
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

    public function getPathFileIsTrash(FileManager $fileManager, bool $isTrash = false)
    {
        foreach ($fileManager->children as $child) {
            if ($child->is_trash == $isTrash && !empty($child->file_type)) {
                $this->arrayFilePath[] = $child->file_path;
            }
            $this->getPathFileIsTrash($child);
        }
        return $this->arrayFilePath;
    }

}
