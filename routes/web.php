<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\GalerijaController;
use App\Http\Controllers\ProizvodController;
use App\Http\Controllers\OblikController;
use App\Http\Controllers\FontController;
use App\Http\Controllers\MaterijalController;
use App\Http\Controllers\NarudzbaController;
use App\Http\Controllers\RazgovorController;
use App\Http\Controllers\PorukaController;
use App\Http\Controllers\KorpaController;
use App\Http\Controllers\ArtikalController;
use App\Http\Controllers\StanjeController;
use App\Http\Controllers\UserController;


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



Route::get('/user',[UserController::class, 'create'])->name('user');
Route::post('/user/{id}',[UserController::class, 'update'])->name('user.update');


Route::post('/poruka',[PorukaController::class, 'store'])->name('poruka');

Route::get('/razgovor/{id?}',[RazgovorController::class, 'create'])->name('razgovor');
Route::post('/razgovor',[RazgovorController::class, 'store']);
Route::get('/poruke',[RazgovorController::class, 'poruke'])->name('poruke');

Route::get('/narudzba',[NarudzbaController::class, 'create'])->name('narudzba');
Route::post('/narudzba',[NarudzbaController::class, 'store']);
Route::post('/narudzba/{id}',[NarudzbaController::class, 'update'])->name('narudzba.update');
Route::get('/narudzbe',[NarudzbaController::class, 'pregled'])->name('narudzba.narudzbe');


Route::get('/stavke/{id}',[KorpaController::class, 'create'])->name('korpa');
Route::post('/stavke',[KorpaController::class, 'store'])->name('korpa.store');
Route::get('/korpa/cart',[KorpaController::class, 'GetCart'])->name('korpa.cart');
Route::get('/korpa/{id}',[KorpaController::class, 'SelektAdd'])->name('korpa.SelektAdd');


Route::get('/galerija',[GalerijaController::class, 'create'])->name('galerija');
Route::post('/galerija',[GalerijaController::class, 'store']);
Route::delete('/galerija/{galerija}',[GalerijaController::class, 'destroy'])->name('galerija.destroy');
Route::post('/galerija/{id}',[GalerijaController::class, 'update'])->name('galerija.update');


Route::get('/proizvodi',[ProizvodController::class, 'create'])->name('proizvodi');
Route::post('/proizvodi',[ProizvodController::class, 'store']);
Route::get('/proizvodi/{proizvod}',[ProizvodController::class, 'show'])->name('proizvodi.show');


Route::post('/proizvodi/{id}',[ProizvodController::class, 'update'])->name('proizvod.update');
Route::post('/proizvodi/{proizvod}',[ProizvodController::class, 'destroy'])->name('proizvodi.destroy');

Route::get('/oblik',[OblikController::class, 'create'])->name('oblik');
Route::post('/oblik',[OblikController::class, 'store']);
Route::delete('/oblik/{oblik}',[OblikController::class, 'destroy'])->name('oblik.destroy');

Route::get('/font',[FontController::class, 'create'])->name('font');
Route::post('/font',[FontController::class, 'store']);
Route::delete('/font/{font}',[FontController::class, 'destroy'])->name('font.destroy');


Route::get('/materijal',[MaterijalController::class, 'create'])->name('materijal');
Route::post('/materijal',[MaterijalController::class, 'store']);
Route::delete('/materijal/{materijal}',[MaterijalController::class, 'destroy'])->name('materijal.destroy');

Route::get('/artikal',[ArtikalController::class, 'create'])->name('artikal');
Route::post('/artikal',[ArtikalController::class, 'store']);
Route::delete('/artikal/{artikal}',[ArtikalController::class, 'destroy'])->name('artikal.destroy');


Route::get('/stanje',[StanjeController::class, 'create'])->name('stanje');
Route::post('/stanje',[StanjeController::class, 'store']);
Route::delete('/stanje/{stanje}',[StanjeController::class, 'destroy'])->name('stanje.destroy');

Route::get('/aGalerija', function () {
    return view('galerija/aGalerija');
})->name('aGalerija');

