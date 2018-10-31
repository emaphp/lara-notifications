<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * @property mixed name
 * @property false|int start_date
 * @property false|int end_date
 * @property mixed place_id
 * @property mixed description
 * @property integer author_id
 * @property mixed start_time
 * @property mixed end_time
 */
class Event extends Model
{

    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function place()
    {
        return $this->belongsTo('App\Place', 'place_id');
    }
    
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    
    use Sluggable;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}
