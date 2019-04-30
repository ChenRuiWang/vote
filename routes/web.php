<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::post('/article', 'ArticleController@store')->name('article.store');
Route::get('/add', 'ArticleController@add')->name('article.add');
//Route::get('/articles', 'ArticleController@index')->name('article.index');
/*Route::edit('/article/{id}', 'ArticleController@edit')->name('article.edit');
Route::put('/article', 'ArticleController@update')->name('article.update');

Route::delete('/article', 'ArticleController@delete')->name('article.delete');*/

//Route::get('/home', 'HomeController@index')->name('home');

/*Route::get('/index', function () {
    return 1;
})->middleware('auth');*/