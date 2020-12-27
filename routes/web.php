<?php

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Back Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){
  Route::get('login', 'App\Http\Controllers\Back\AuthController@login')->name('login');
  Route::post('login', 'App\Http\Controllers\Back\AuthController@loginPost')->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
  Route::get('panel', 'App\Http\Controllers\Back\Dashboard@index')->name('dashboard');

  //Article routes
  Route::get('articles/deleted', 'App\Http\Controllers\Back\ArticleController@trashed')->name('trashed.article');
  Route::resource('articles', 'App\Http\Controllers\Back\ArticleController');
  Route::get('/switch', 'App\Http\Controllers\Back\ArticleController@switch')->name('switch');
  Route::get('/deletearticle/{id}', 'App\Http\Controllers\Back\ArticleController@delete')->name('delete.article');
  Route::get('/harddeletearticle/{id}', 'App\Http\Controllers\Back\ArticleController@hardDelete')->name('hard.delete.article');
  Route::get('/recoverarticle/{id}', 'App\Http\Controllers\Back\ArticleController@recover')->name('recover.article');

  //Category routes
  Route::get('/categories', 'App\Http\Controllers\Back\CategoryController@index')->name('category.index');
  Route::post('/categories/create', 'App\Http\Controllers\Back\CategoryController@create')->name('category.create');
  Route::post('/categories/update', 'App\Http\Controllers\Back\CategoryController@update')->name('category.update');
  Route::post('/categories/delete', 'App\Http\Controllers\Back\CategoryController@delete')->name('category.delete');
  Route::get('/category/status', 'App\Http\Controllers\Back\CategoryController@switch')->name('category.switch');
  Route::get('/category/getData', 'App\Http\Controllers\Back\CategoryController@getData')->name('category.getdata');

  //Pages routes
  Route::get('/pages', 'App\Http\Controllers\Back\PageController@index')->name('page.index');
  Route::get('/pages/create', 'App\Http\Controllers\Back\PageController@create')->name('page.create');
  Route::post('/pages/create', 'App\Http\Controllers\Back\PageController@createPage')->name('page.create');
  Route::get('/pages/edit/{id}', 'App\Http\Controllers\Back\PageController@edit')->name('page.edit');
  Route::post('/pages/update/{id}', 'App\Http\Controllers\Back\PageController@updatePage')->name('page.update');
  Route::get('/page/switch', 'App\Http\Controllers\Back\PageController@switch')->name('page.switch');
  Route::get('/pages/delete/{id}', 'App\Http\Controllers\Back\PageController@delete')->name('page.delete');
  Route::get('/pages/sorting', 'App\Http\Controllers\Back\PageController@sorting')->name('page.sorting');



  //
  Route::get('logout', 'App\Http\Controllers\Back\AuthController@logout')->name('logout');
});




/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'App\Http\Controllers\Front\Homepage@index')->name('homepage');
Route::get('/kategori/{category}', 'App\Http\Controllers\Front\Homepage@category')->name('category');
Route::get('/iletisim', 'App\Http\Controllers\Front\Homepage@contact')->name('contact');

Route::post('/iletisim', 'App\Http\Controllers\Front\Homepage@contactPost')->name('contact.post');

Route::get('/{category}/{slug}', 'App\Http\Controllers\Front\Homepage@single')->name('single');
Route::get('/{sayfa}', 'App\Http\Controllers\Front\Homepage@page')->name('page');
