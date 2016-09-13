<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
   protected $table = "articles";
   use softDeletes;

   /**
   	* The attributes that should be mutated to dates.
   	*
   	* @var array
   	*/
   protected $dates = ['deleted_at'];
   
   public function user()
   {
   	return $this->belongsTo('App\User');
   }
   public function categories()
   {
   	return $this->belongsToMany('App\Category', 'category_article');
   }
}
