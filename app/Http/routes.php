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
Route::get('/artigo/{title}/{id}', [
    'as' => 'public.view', 'uses' => 'PublicController@view'
]);
Route::get('/categoria/{title}/{id}', [
    'as' => 'public.category', 'uses' => 'PublicController@category'
]);
Route::get('/autor/{name}/{id}', [
    'as' => 'public.author', 'uses' => 'PublicController@author'
]);
Route::get('/teste', [
    'as' => 'admin.teste', 'uses' => 'AdminController@teste'
]);
Route::get('/admin', [
    'as' => 'admin.login', 'uses' => 'UserController@getAuthenticate'
]);
Route::post('/admin', [
    'as' => 'admin.postLogin', 'uses' => 'UserController@authenticate'
]);

Route::group(['middleware' => ['auth']], function () {

	Route::controller('/admin/categoria', 'CategoryController', [
		'getCadastro' 	=> 'category.register',
		'getIndex' 		=> 'category.list',
		'getAlterar' 	=> 'category.edit',
		'deleteDeletar' => 'category.delete',
	]);
	Route::controller('/admin/artigo', 'ArticleController', [
		'getCadastro' 	=> 'article.register',
		'getEditar' 	=> 'article.edit',
		'getEditarConteudo' 	=> 'article.edit.content',
		'getIndex' 		=> 'article.list',
		'getAlterarStatus' 		=> 'article.edit.status',
		'getAlterarManchete' 		=> 'article.edit.headline',
		// 'getAlterar' 	=> 'article.update',
		'deleteRemover' => 'article.delete',
	]);

	Route::controller('/admin/usuario', 'UserController', [
		'getRegistro'	=> 'user.register',
		'getEditar' 	=> 'user.edit',
	]);

});

Route::auth();

Route::get('/home', 'HomeController@index');
