<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebController;
use App\Http\Controllers\MotorBusquedaController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConektaController;
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

/* 
    RUTAS PARA PAGINA WEB EN ESPAÑOL
*/

// Route::get('/clear-cache', function () {
//    echo Artisan::call('config:clear');
//    echo Artisan::call('config:cache');
//    echo Artisan::call('cache:clear');
//    echo Artisan::call('route:clear');
// });

Route::get('/', function () {
    return view('web.index')->with('lang', App::getLocale())->with('sesion', request()->session()->get('lang'));
});
Route::get('/transporte-cancun-playa-carmen', [WebController::class, 'playaDelCarmen']);
Route::get('/transporte-cancun-tulum', [WebController::class, 'tulum']);
Route::get('/transporte-cancun-bacalar', [WebController::class, 'bacalar']);
Route::get('/tours-quintanaroo', [WebController::class, 'tours']);
Route::get('/tours/{tour}/{id}', [MotorBusquedaController::class, 'cotizarTour']);
Route::get('/detalle-de-viaje', [MotorBusquedaController::class, 'detailTrip']);
Route::get('/gracias', [WebController::class, 'gracias'])->name('es-gracias');

/*
    RUTAS RESERVATION
*/
Route::post('/make-reservation-tour', [MotorBusquedaController::class, 'MakeBookingTour']);
Route::post('/make-reservation-trip', [MotorBusquedaController::class, 'MakeBookingTrip']);
Route::post('/make-reservation-custom', [MotorBusquedaController::class, 'MakeBookingTripCustom']);

/*
    RUTAS CONEKTA
*/
Route::post('/conekta-tour', [ConektaController::class, 'MakePayByTour']);
Route::post('/conekta-transfer', [ConektaController::class, 'MakePayByTransfer']);
Route::get('/response-conekta/tour', [ConektaController::class, 'ResponseConektaTour']);
Route::get('/response-conekta/transfer', [ConektaController::class, 'ResposeConektaTransfer']);
Route::get('/response-conekta-error', [ConektaController::class, 'ErrorResponse']);

/* 
    RUTAS PARA PAGINA WEB EN INGLES
*/

Route::group(['prefix' => 'en'], function(){
    Route::get('/', function () {
        return view('web.index')->with('lang', App::getLocale())->with('sesion', request()->session()->get('lang'));
    });
    Route::get('/cancun-airport-shuttle-playa-carmen', [WebController::class, 'playaDelCarmen']);
    Route::get('/cancun-airport-shuttle-tulum', [WebController::class, 'tulum']);
    Route::get('/cancun-airport-shuttle-bacalar', [WebController::class, 'bacalar']);
    Route::get('/tours', [WebController::class, 'tours']);
    Route::get('/tours/{tour}/{id}', [MotorBusquedaController::class, 'cotizarTour']);
    Route::get('/trip-detail', [MotorBusquedaController::class, 'detailTrip']);
    Route::get('/thanks', [WebController::class, 'gracias'])->name('en-thanks');
});

/* 
    RUTAS PARA FUNCIONES ESPECIALES DE LA PAGINA WEB 
*/

Route::get('/motorbusqueda', [WebController::class, 'motorbusqueda']);
Route::post('/changelenguage', [WebController::class, 'ChangeLenguage']);
Route::get('/back/locations', [MotorBusquedaController::class, 'GetLocation']);

/* 
    RUTAS PARA ADMIN
*/

Route::get('/admin-marcshuttle/login', [LoginController::class, 'index']);
Route::post('/admin-marcshuttle/login', [Logincontroller::class, 'login'])->name('login');
Route::get('/admin-marcshuttle/logout', [LoginController::class, 'logout']);


Route::group(['middleware' => 'userAuth', 'prefix' => 'admin-marcshuttle'], function(){
    Route::get('panel', [AdminController::class, 'Home']);
    Route::get('nuevo-usuario', [AdminController::class, 'NuevoUsuario']);
    Route::post('create-user', [AdminController::class, 'CreateUser']);
});
