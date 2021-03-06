<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $table = "tag";

    public function articles()
    {
        return $this->belongsToMany('App\Article', 'category_article');
    }
}
