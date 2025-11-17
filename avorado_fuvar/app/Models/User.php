<?php
// app/Models/User.php (Részlet)

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // A trait EBBEN az osztályban van!
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $role
 * @property Vehicle[] $vehicles
 * @property Work[] $works
 */
class User extends Authenticatable
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = [
        'name', 
        'email',  
        'password', 
        'role',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles()
    {
        return $this->hasMany('App\Models\Vehicle', 'carrier');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function works()
    {
        return $this->hasMany('App\Models\Work', 'carrier');
    }
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
}
