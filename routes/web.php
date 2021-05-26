<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;



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


Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'store']);

Route::get('/register',[RegisterController::class, 'index'])->name('register');
Route::post('/register',[RegisterController::class, 'store']);


Route::post('/logout',[LogoutController::class, 'store'])->name('logout');

Route::get('/kontakt', function () {
    return view('kontakt/kontakt');
})->name('kontakt');

Route::get('/onama', function () {
    return view('ONama/onama');
})->name('onama');
Route::get('/narudzba', function () {
    return view('narudzba/narudzba');
})->name('narudzba');
Route::get('/narudzbe', function () {
    return view('narudzba/narudzbe');
})->name('narudzbe');
Route::get('/narudzba/{narudzba}', function () {
    return view('narudzba/narudzba');
})->name('Onarudzba');

Route::get('/galerija', function () {
    return view('galerija/galerija');
})->name('galerija');
Route::get('/aGalerija', function () {
    return view('galerija/aGalerija');
})->name('aGalerija');

Route::get('/', function () {
    return view('proizvodi/proizvodi');
})->name('proizvodi');

