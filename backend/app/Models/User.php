<?php

namespace App\Models;

use App\Enums\UserStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * User class that handles all users.
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Laravel\Sanctum\HasApiTokens;

    /**
     * The attributes that should be appended.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'full_name',
        'initials',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => UserStatus::class,
        'deleted_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'phone',
        'email',
        'type',
        'status',
        'email_verified_at',
        'last_login_at',
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
    ];

    /**
     * Get Users full name, first and last name
     */
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * Get Users initials from first and last name
     */
    public function getInitialsAttribute()
    {
        return strtoupper(substr($this->first_name, 0, 1)).strtoupper(substr($this->last_name, 0, 1));
    }

    /**
     * Pulls all active Users.
     */
    public static function scopeActive(Builder $query): Builder
    {
        return $query->where('status', UserStatus::active);
    }

    /**
     * Pulls all archived Users.
     */
    public static function scopeArchived(Builder $query): Builder
    {
        return $query->where('status', UserStatus::archived);
    }

    /**
     * Pulls all banned Users.
     */
    public static function scopeBanned(Builder $query): Builder
    {
        return $query->where('status', UserStatus::banned);
    }

    /**
     * Pulls all inactive Users.
     */
    public static function scopeInactive(Builder $query): Builder
    {
        return $query->where('status', UserStatus::inactive);
    }

    /**
     * Pulls all pending Users.
     */
    public static function scopePending(Builder $query): Builder
    {
        return $query->where('status', UserStatus::pending);
    }
}
