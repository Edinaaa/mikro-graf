<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\GalerijaController;
use App\Http\Controllers\ProizvodController;
use App\Http\Controllers\OblikController;
use App\Http\Controllers\FontController;
use App\Http\Controllers\MaterijalController;
use App\Http\Controllers\NarudzbaController;
use App\Http\Controllers\RazgovorController;
use App\Http\Controllers\PorukaController;
use App\Http\Controllers\KorpaController;
use App\Http\Controllers\KategorijaController;
use App\Http\Controllers\StanjeController;
use App\Http\Controllers\StavkeController;

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


Route::get('/resetpass',[ResetPasswordController::class, 'index'])->name('resetpassword');
Route::post('/resetpass',[ResetPasswordController::class, 'create']);
Route::get('/newpass',[ResetPasswordController::class, 'newpass'])->name('newpass');
Route::post('/novalozinka',[ResetPasswordController::class, 'novalozinka'])->name('novalozinka');
Route::get('/reloadcaptcha', [ResetPasswordController::class, 'reloadCaptcha']);


Route::get('/kontakt',[KontaktController::class, 'create'])->name('kontakt');

Route::get('/onama', function () {
    return view('ONama/onama');
})->name('onama');


Route::get('/home', function () {
    return view('home/home');
})->name('home');

Route::get('/', function () {
    return redirect('/home');
});

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


Route::get('/stavke/{id}',[StavkeController::class, 'create'])->name('stavke');


Route::get('/korpa/cart',[KorpaController::class, 'GetCart'])->name('korpa.cart');
Route::get('/korpa/{id}',[KorpaController::class, 'SelektAdd'])->name('korpa.SelektAdd');
Route::get('/korpa',[KorpaController::class, 'odustani'])->name('korpa.odustani');



Route::get('/galerija',[GalerijaController::class, 'create'])->name('galerija');
Route::post('/galerija',[GalerijaController::class, 'store']);
Route::delete('/galerija/{galerija}',[GalerijaController::class, 'destroy'])->name('galerija.destroy');
Route::get('/galerija/{galerija}',[GalerijaController::class, 'show'])->name('galerija.show');
Route::post('/galerija/{id}',[GalerijaController::class, 'update'])->name('galerija.update');


Route::get('/proizvodi',[ProizvodController::class, 'create'])->name('proizvodi');
Route::post('/proizvodi',[ProizvodController::class, 'store']);
Route::get('/proizvodi/{proizvod}',[ProizvodController::class, 'show'])->name('proizvodi.show');
Route::post('/proizvodi/{id}',[ProizvodController::class, 'update'])->name('proizvod.update');
Route::delete('/proizvodi/{proizvod}',[ProizvodController::class, 'destroy'])->name('proizvod.destroy');

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

Route::get('/kategorija',[KategorijaController::class, 'create'])->name('kategorija');
Route::post('/kategorija',[KategorijaController::class, 'store']);
Route::get('/kategorija/{kategorija}',[KategorijaController::class, 'show'])->name('kategorija.show');
Route::post('/kategorija/{id}',[KategorijaController::class, 'update'])->name('kategorija.update');

Route::get('/stanje',[StanjeController::class, 'create'])->name('stanje');
Route::post('/stanje',[StanjeController::class, 'store']);
Route::get('/stanje/{stanje}',[StanjeController::class, 'show'])->name('stanje.show');
Route::post('/stanje/{id}',[StanjeController::class, 'update'])->name('stanje.update');

Route::post('/telefon-verification', [VerifikacijaController::class, 'TelefonVerifikacija'])->name('TelefonVerifikacija');
Route::get('/telefon-form', [Verifikacijaontroller::class, 'telefonForm'])->name('telefonForm');
Route::get('/contact-form', [VerifikacijaController::class, 'contactForm'])->name('contactForm');
Route::post('/contact-captcha-verification', [VerifikacijaController::class, 'contactCaptchaVerifikacija'])->name('contactCaptchaVerification');
Route::get('/reload-captcha', [VerifikacijaController::class, 'reloadCaptcha']);

