<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\GalerijaController;
use App\Http\Controllers\ProizvodController;
use App\Http\Controllers\OblikController;
use App\Http\Controllers\FontController;
use App\Http\Controllers\MaterijalController;




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


Route::get('/galerija',[GalerijaController::class, 'create'])->name('galerija');
Route::post('/galerija',[GalerijaController::class, 'store']);
Route::delete('/galerija/{galerija}',[GalerijaController::class, 'destroy'])->name('galerija.destroy');


Route::get('/proizvodi',[ProizvodController::class, 'create'])->name('proizvodi');
Route::post('/proizvodi',[ProizvodController::class, 'store']);
Route::delete('/proizvodi/{proizvodi}',[ProizvodController::class, 'destroy'])->name('proizvodi.destroy');

Route::get('/oblik',[OblikController::class, 'create'])->name('oblik');
Route::post('/oblik',[OblikController::class, 'store']);
Route::delete('/oblik/{oblik}',[OblikController::class, 'destroy'])->name('oblik.destroy');

Route::get('/font',[FontController::class, 'create'])->name('font');
Route::post('/font',[FontController::class, 'store']);
Route::delete('/font/{font}',[FontController::class, 'destroy'])->name('font.destroy');


Route::get('/materijal',[MaterijalController::class, 'create'])->name('materijal');
Route::post('/materijal',[MaterijalController::class, 'store']);
Route::delete('/materijal/{materijal}',[MaterijalController::class, 'destroy'])->name('materijal.destroy');


Route::get('/aGalerija', function () {
    return view('galerija/aGalerija');
})->name('aGalerija');

