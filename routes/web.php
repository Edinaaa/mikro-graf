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
use App\Http\Controllers\CaptchaServiceController;
use App\Http\Controllers\KontaktController;






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

Route::get('/kontakt',[KontaktController::class, 'create'])->name('kontakt');

Route::get('/onama', function () {
    return view('ONama/onama');
})->name('onama');


Route::get('/home', function () {
    return view('home/home');
})->name('home');

Route::get('/user',[UserController::class, 'create'])->name('user');
Route::post('/user/{id}',[UserController::class, 'update'])->name('user.update');


Route::post('/poruka',[PorukaController::class, 'store'])->name('poruka');

Route::get('/razgovor/{id?}',[RazgovorController::class, 'create'])->name('razgovor');
Route::post('/razgovor',[RazgovorController::class, 'store']);
Route::get('/poruke',[RazgovorController::class, 'poruke'])->name('poruke');

Route::get('/narudzba',[NarudzbaController::class, 'create'])->name('narudzba');
Route::post('/narudzba',[NarudzbaController::class, 'store']);
Route::get('/narudzba/{narudzba}',[NarudzbaController::class, 'show'])->name('narudzba.show');
Route::post('/narudzba/{id}',[NarudzbaController::class, 'update'])->name('narudzba.update');
Route::get('/narudzbe',[NarudzbaController::class, 'pregled'])->name('narudzba.narudzbe');
Route::get('/NarudzbaGost',[NarudzbaController::class, 'NarudzbaGost'])->name('narudzba.NarudzbaGost');


Route::get('/stavke/{id}',[KorpaController::class, 'create'])->name('korpa');
Route::get('/korpa/cart',[KorpaController::class, 'GetCart'])->name('korpa.cart');
Route::get('/korpa/{id}',[KorpaController::class, 'SelektAdd'])->name('korpa.SelektAdd');


Route::get('/galerija',[GalerijaController::class, 'create'])->name('galerija');
Route::post('/galerija',[GalerijaController::class, 'store']);
Route::delete('/galerija/{galerija}',[GalerijaController::class, 'destroy'])->name('galerija.destroy');
Route::get('/galerija/{galerija}',[GalerijaController::class, 'show'])->name('galerija.show');
Route::post('/galerija/{id}',[GalerijaController::class, 'update'])->name('galerija.update');


Route::get('/proizvodi',[ProizvodController::class, 'create'])->name('proizvodi');
Route::post('/proizvodi',[ProizvodController::class, 'store']);
Route::get('/proizvodi/{proizvod}',[ProizvodController::class, 'show'])->name('proizvodi.show');
Route::post('/proizvodi/{id}',[ProizvodController::class, 'update'])->name('proizvod.update');

Route::get('/oblik',[OblikController::class, 'create'])->name('oblik');
Route::post('/oblik',[OblikController::class, 'store']);
Route::get('/oblik/{oblik}',[OblikController::class, 'show'])->name('oblik.show');
Route::post('/oblik/{id}',[OblikController::class, 'update'])->name('oblik.update');


Route::get('/font',[FontController::class, 'create'])->name('font');
Route::post('/font',[FontController::class, 'store']);
Route::get('/font/{font}',[FontController::class, 'show'])->name('font.show');
Route::post('/font/{id}',[FontController::class, 'update'])->name('font.update');


Route::get('/materijal',[MaterijalController::class, 'create'])->name('materijal');
Route::post('/materijal',[MaterijalController::class, 'store']);
Route::get('/materijal/{materijal}',[MaterijalController::class, 'show'])->name('materijal.show');
Route::post('/materijal/{id}',[MaterijalController::class, 'update'])->name('materijal.update');
Route::get('/materijal/selectshow',[MaterijalController::class, 'selectshow'])->name('materijal.selectshow');

Route::get('/artikal',[ArtikalController::class, 'create'])->name('artikal');
Route::post('/artikal',[ArtikalController::class, 'store']);
Route::get('/artikal/{artikal}',[ArtikalController::class, 'show'])->name('artikal.show');
Route::post('/artikal/{id}',[ArtikalController::class, 'update'])->name('artikal.update');

Route::get('/stanje',[StanjeController::class, 'create'])->name('stanje');
Route::post('/stanje',[StanjeController::class, 'store']);
Route::get('/stanje/{stanje}',[StanjeController::class, 'show'])->name('stanje.show');
Route::post('/stanje/{id}',[StanjeController::class, 'update'])->name('stanje.update');

Route::post('/telefon', [CaptchaServiceController::class, 'TelefonValidate'])->name('telefon');
Route::get('/telefon', [CaptchaServiceController::class, 'CreateTelefon'])->name('CreateTelefon');
Route::get('/contact-form', [CaptchaServiceController::class, 'index'])->name('captchaform');
Route::post('/captcha-validation', [CaptchaServiceController::class, 'capthcaFormValidate'])->name('captchaValidate');
Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);

