<?php

namespace Ntlong050801\FileManager\app\Models;

use App\Models\Address;
use App\Models\Company;
use App\Models\Order;
use App\Models\Scopes\CurrentCompanyScope;
use App\Models\Setting;
use App\Models\Traits\HasActivityTrait;
use App\Models\Traits\HasNotifiableTrait;
use App\Models\Traits\HasSlugTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static where(string $string, $companyId)
 */
class User extends \App\Models\User
{
    protected $fillable = [
        'memory',
        'used_memory'
    ];

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(FileManager::class, 'file_user', 'user_id', 'file_id')->withPivot('is_click_permission');
    }
}
