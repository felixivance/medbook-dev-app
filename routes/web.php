<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('pages.login');
})->name('main');

Auth::routes();

Route::get('/admin/{any?}/{component?}', function () {
    if(Auth::user() == null){
        return redirect()->route('main');
    }else{
        return view('pages.main');
    }
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('logout', [
    'as' => 'logout',
    function () {
        Auth::logout();
        return redirect()->route('main');
    }
]);
