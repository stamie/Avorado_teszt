<?php

namespace App\Models;

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
 * @property boolean $is_admin
 * @property Vehicle[] $vehicles
 * @property Work[] $works
 */
class User extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 
        'email',  
        'password', 
        'is_admin',
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
}
