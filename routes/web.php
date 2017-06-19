<?php

use App\Entities\Scientist;
use App\Entities\Theory;

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

Route::get('/add-scientish', function () {
    $scientist = new Scientist(
        'Albert', 
        'Einstein'
    );

    $scientist->addTheory(
        new Theory('Theory of relativity')
    );

    EntityManager::persist($scientist);
    EntityManager::flush();
});

Route::get('/scientish', function () {
    $scientist = EntityManager::find(Scientist::class, 1);
    dd($scientist);
    dd($scientist);
});
