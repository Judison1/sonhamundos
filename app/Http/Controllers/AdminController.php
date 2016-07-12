<?php

/**
* 
*/
namespace App\Http\Controllers;
use App\Article;
use App\Category;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\FileController;

class AdminController extends Controller
{
	public function teste()
	{
		$files = new FileController('teste');
		var_dump($files->getDirectory());
	}
}