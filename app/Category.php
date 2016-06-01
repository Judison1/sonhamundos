<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
   protected $table = "category";
   use softDeletes;

   /**
   	* The attributes that should be mutated to dates.
   	*
   	* @var array
   	*/
   protected $dates = ['deleted_at'];

   public function user()
   {
   	return $this->hasOne('App\User');
   }
   public function articles()
   {
   	return $this->belongsToMany('App\Category', 'category_article');
   }

}
