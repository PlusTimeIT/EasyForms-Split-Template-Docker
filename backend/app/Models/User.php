<?php
namespace App\Models;

use App\Enums\{UserStatus, UserTypes};
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\{Builder, SoftDeletes};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

/**
 * User class that handles all users.
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    use \Laravel\Sanctum\HasApiTokens;
    use \Illuminate\Database\Eloquent\SoftDeletes;

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
     *
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get Users initials from first and last name
     *
     */
    public function getInitialsAttribute()
    {
        return strtoupper(substr($this->first_name, 0, 1)) . strtoupper(substr($this->last_name, 0, 1));
    }

    /**
     * Pulls all active Users.
     * @param  Builder  $query
     * @return Builder
     */
    public static function scopeActive(Builder $query): Builder
    {
        return $query->where('status', UserStatus::active);
    }

    /**
     * Pulls all archived Users.
     * @param  Builder  $query
     * @return Builder
     */
    public static function scopeArchived(Builder $query): Builder
    {
        return $query->where('status', UserStatus::archived);
    }

    /**
     * Pulls all banned Users.
     * @param  Builder  $query
     * @return Builder
     */
    public static function scopeBanned(Builder $query): Builder
    {
        return $query->where('status', UserStatus::banned);
    }

    /**
     * Pulls all inactive Users.
     * @param  Builder  $query
     * @return Builder
     */
    public static function scopeInactive(Builder $query): Builder
    {
        return $query->where('status', UserStatus::inactive);
    }

    /**
     * Pulls all pending Users.
     * @param  Builder  $query
     * @return Builder
     */
    public static function scopePending(Builder $query): Builder
    {
        return $query->where('status', UserStatus::pending);
    }

}
