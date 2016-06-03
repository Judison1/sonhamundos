<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'as' => 'public.index', 'uses' => 'PublicController@index'
]);
Route::get('/admin/login', [
    'as' => 'admin.login', 'uses' => 'UserController@getAuthenticate'
]);
Route::post('/admin/login', [
    'as' => 'admin.postLogin', 'uses' => 'UserController@authenticate'
]);

Route::controller('/admin/categoria', 'CategoryController', [
	'getCadastro' 	=> 'category.register',
	'getIndex' 		=> 'category.list',
	'getAlterar' 	=> 'category.update',
	'deleteDeletar' => 'category.delete',
]);
Route::controller('/admin/artigo', 'ArticleController', [
	'getCadastro' 	=> 'article.register',
	'getEditarImagem' 	=> 'article.editImg',
	// 'getIndex' 		=> 'article.list',
	// 'getAlterar' 	=> 'article.update',
	// 'deleteDeletar' => 'article.delete',
]);