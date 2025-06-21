<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'rfc',
        'direction',
        'position',
        'sex',
        'lvl',
        'tipo',
        'status',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'boolean',
            'tipo' => 'integer',
        ];
    }

    /**
     * Get the services where this user is the first applicant.
     */

    /**
     * Get the services where this user is the second applicant.
     */
    public function servicesAsSolicitante(): HasMany
    {
        return $this->hasMany(Service::class, 'solicitante_id');
    }

    /**
     * Get the services where this user performed the service.
     */
    public function servicesAsEfectuo(): HasMany
    {
        return $this->hasMany(Service::class, 'efectuo_id');
    }

    /**
     * Get the services where this user gave approval (VºBº).
     */
    public function servicesAsVobo(): HasMany
    {
        return $this->hasMany(Service::class, 'vobo_id');
    }

    /**
     * Get the services where this user captured the service.
     */
    public function servicesAsCapturo(): HasMany
    {
        return $this->hasMany(Service::class, 'capturo');
    }

    /**
     * Get all services related to this user in any capacity.
     */
    public function allServices()
    {
        return Service::where('solicitante_id', $this->id)            
            ->orWhere('efectuo_id', $this->id)
            ->orWhere('vobo_id', $this->id)
            ->orWhere('capturo', $this->id);
    }

    /**
     * Get the inventory items owned by this user.
     */
    public function inventoryItems(): HasMany
    {
        return $this->hasMany(Inventory::class, 'user_id');
    }

    /**
     * Get the inventory items where this user is responsible.
     */
    public function responsibleInventoryItems(): HasMany
    {
        return $this->hasMany(Inventory::class, 'res_id');
    }

    /**
     * Get all inventory items related to this user.
     */
    public function allInventoryItems()
    {
        return Inventory::where('user_id', $this->id)
            ->orWhere('res_id', $this->id);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => mb_convert_encoding($value, 'UTF-8', 'auto'),
            set: fn ($value) => mb_convert_encoding($value, 'UTF-8', 'auto')
        );
    }

    protected function direction(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => mb_convert_encoding($value, 'UTF-8', 'auto'),
            set: fn ($value) => mb_convert_encoding($value, 'UTF-8', 'auto')
        );
    }

    protected function position(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => mb_convert_encoding($value, 'UTF-8', 'auto'),
            set: fn ($value) => mb_convert_encoding($value, 'UTF-8', 'auto')
        );
    }
}
