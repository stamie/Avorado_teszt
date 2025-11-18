<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @property integer $id
 * @property integer $status
 * @property integer $carrier
 * @property string $start_place
 * @property string $end_place
 * @property string $recipient_name
 * @property string $recipient_phone
 * @property string $created_at
 * @property string $updated_at
 * @property Status $status
 * @property User $user
 */
class Work extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['status', 'carrier', 'start_place', 'end_place', 'recipient_name', 'recipient_phone', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status_()
    {
        return $this->belongsTo('App\Models\Status', 'status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'carrier');
    }
}
