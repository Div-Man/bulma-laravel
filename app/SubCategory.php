<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public function images()
    {
        return $this->belongsToMany('App\Image');
    }
    
    public function videos()
    {
        return $this->belongsToMany('App\Video');
    }
}
