<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
	protected $table = "permission";
   use softDeletes;

   /**
   	* The attributes that should be mutated to dates.
   	*
   	* @var array
   	*/
   protected $dates = ['deleted_at'];

   public function users()
   {
   	return $this->hasMany("App\User");
   }

}
