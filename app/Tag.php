<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** 
     * Get all of the events that are assigned this tag
    */
    public function events(){
        return $this->morphedByMany('App\Event', 'taggable');
    }


    /** 
     * Get all of the places that are assigned this tag
    */
    public function places(){
        return $this->morphedByMany('App\Place', 'taggable');
    }



}
