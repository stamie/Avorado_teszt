<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $carrier
 * @property string $brand
 * @property string $type
 * @property string $licence_plate
 * @property User $user
 */
class Vehicle extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['carrier', 'brand', 'type', 'licence_plate'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'carrier');
    }
}
