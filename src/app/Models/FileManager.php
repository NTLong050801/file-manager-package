<?php

namespace Ntlong050801\FileManager\app\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(FileManager::class, 'parent_id');
    }

    protected function fileSize(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->formatFileSize($value),
        );
    }

    private function formatFileSize($bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        return round($bytes, 2) . ' ' . $units[$pow];
    }


}
