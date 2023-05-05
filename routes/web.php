<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebController;
use App\Http\Controllers\MotorBusquedaController;
use App\Http\Controllers\PaypalController;
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
    return view('web.index')->with('lang', App::getLocale())->with('sesion', request()->session()->get('lang'));
});
Route::get('/transporte-cancun-playa-carmen', [WebController::class, 'playaDelCarmen']);
Route::get('/transporte-cancun-tulum', [WebController::class, 'tulum']);
Route::get('/transporte-cancun-bacalar', [WebController::class, 'bacalar']);
Route::get('/tours-quintanaroo', [WebController::class, 'tours']);
Route::get('/tours/{tour}/{id}', [MotorBusquedaController::class, 'cotizarTour']);
//Route::get('/acerca-de-nosotros',[WebController::class, 'about']);
Route::get('/detalle-de-viaje', [MotorBusquedaController::class, 'detailTrip']);
Route::post('/gracias', [MotorBusquedaController::class, "BookingTransfer"]);
Route::get('/gracias', function(){
    return redirect('/');
});


Route::group(['prefix' => 'en'], function(){
    Route::get('/', function () {
        return view('web.index')->with('lang', App::getLocale())->with('sesion', request()->session()->get('lang'));
    });
    Route::get('/cancun-airport-shuttle-playa-carmen', [WebController::class, 'playaDelCarmen']);
    Route::get('/cancun-airport-shuttle-tulum', [WebController::class, 'tulum']);
    Route::get('/cancun-airport-shuttle-bacalar', [WebController::class, 'bacalar']);
    Route::get('/tours', [WebController::class, 'tours']);
    Route::get('/tours/{tour}/{id}', [MotorBusquedaController::class, 'cotizarTour']);
  //  Route::get('/about-us',[WebController::class, 'about']);
    Route::get('/trip-detail', [MotorBusquedaController::class, 'detailTrip']);
    Route::post('/thanks', [MotorBusquedaController::class, "BookingTransfer"]);
    Route::post('/thanks', [MotorBusquedaController::class, "BookingTransfer"]);
    Route::get('/thanks', function(){
        return redirect('/en');
    });
});

Route::get('/motorbusqueda', [WebController::class, 'motorbusqueda']);
Route::post('/changelenguage', [WebController::class, 'ChangeLenguage']);
Route::get('/back/locations', [MotorBusquedaController::class, 'GetLocation']);
Route::post('/checkout/api/paypal/order', [PaypalController::class, 'CheckoutOrder']);


Route::post('/sendcustomtrip', [MotorBusquedaController::class, 'SendCustomTrip']);



Route::get('/email', function(){
    return view('emails.detailTrip');
} );