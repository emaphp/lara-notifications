<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    
    /**
     * Get all of the tags for the places.
     */
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    public function events()
    {
        return $this->hasMany('App\Event', 'place_id');
    }
}