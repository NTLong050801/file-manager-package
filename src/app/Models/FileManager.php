<?php

namespace Ntlong050801\FileManager\app\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
