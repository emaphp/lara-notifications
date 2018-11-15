<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int week
 * @property int year
 * @property int order
 * @property int user_id
 * @property int fallback_user_id
 */
class BreakfastLog extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
