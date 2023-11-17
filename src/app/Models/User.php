<?php

namespace App\Models;

use App\Models\Scopes\CurrentCompanyScope;
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
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use HasSlugTrait;
    use HasActivityTrait;
    use HasNotifiableTrait;

    protected $table = 'users';
    const TOKEN_DOWNLOAD_DOCUMENT = 'download-document';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'name',
        'email',
        'phone',
        'username',
        'password',
        'company_id',
        'avatar',
        'google2fa_secret',
        'google2fa_enable',
        'province_id',
        'district_id',
        'ward_id',
        'customer_source',
        'customer_type',
        'notification_settings',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'notification_settings' => 'array',
    ];

    public array $customActivityOptions = [
        'logExceptAttributes' => ['password','remember_token'],
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new CurrentCompanyScope());
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_user', 'user_id', 'order_id');
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (empty($this->attributes['avatar'])) {
                    return (new \Laravolt\Avatar\Avatar)->create($this->name)->toBase64();
                }
                return asset('storage/'.$this->attributes['avatar']);
            }
        );
    }

    public static function getValueByKey($key, $companyId = null)
    {
        $companyId = empty($companyId) ? session('company_id') : $companyId;
        $setting = Setting::where('company_id', $companyId)->where('key', $key)->get();
        if (isset($setting->first()->value)) {
            return $setting->first()->value;
        }
    }

    protected function fullAddress(): Attribute
    {
        return Attribute::make(
            get: function () {
                return Address::buildFullAddress($this->province_id, $this->district_id, $this->ward_id);
            }
        );
    }

    public function descriptionForActivityEvent()
    {
        return fn(string $eventName) => __('activitylog.'.$this->table).$this->name." được ".__('activitylog.'.$eventName);
    }

    public function generateCodeDownloadDocument(int $orderId): string
    {
        return self::TOKEN_DOWNLOAD_DOCUMENT.$orderId;
    }
}
