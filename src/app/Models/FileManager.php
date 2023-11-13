<?php

namespace Ntlong050801\FileManager\app\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileManager extends Model
{
   protected $table = 'file_manager';

   protected $fillable = [
     'name',
     'file_path',
     'parent_id',
     'user_id',
   ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
