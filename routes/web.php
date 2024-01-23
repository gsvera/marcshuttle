<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebController;
use App\Http\Controllers\MotorBusquedaController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConektaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZonasController;
use App\Http\Controllers\UbicacionesController;
use App\Http\Controllers\ToursController;
use App\Http\Controllers\VehiclesController;
use App\Http\Controllers\BookingsTripController;
use App\Http\Controllers\BookingsTourController;
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
Route::post('/back/locations', [MotorBusquedaController::class, 'GetLocation']);
Route::get('/back/zone', [MotorBusquedaController::class, 'GetZone']);

/* 
    RUTAS PARA ADMIN
*/

Route::get('/admin-marcshuttle/login', [LoginController::class, 'index']);
Route::post('/admin-marcshuttle/login', [Logincontroller::class, 'login'])->name('login');
Route::get('/admin-marcshuttle/logout', [LoginController::class, 'logout']);
Route::get('/admin-marcshuttle/forget-password', [LoginController::class, 'ForgetPasswordView'])->name('forget-password');
Route::post('/admin-marcshuttle/send-token-reset-password', [LoginController::class, 'sendTokenResetPassword']);
Route::get('/admin-marcshuttle/reset-password', [LoginController::class, 'resetPasswordView']);
Route::post('/admin-marcshuttle/save-new-reset-password', [LoginController::class, 'saveNewResetPassword']);

Route::group(['middleware' => 'userAuth', 'prefix' => 'admin-marcshuttle'], function(){
    Route::get('panel', [AdminController::class, 'Home']);
    Route::get('user', [AdminController::class, 'user']);
    Route::get('zona', [AdminController::class, 'zona']);
    Route::get('location', [AdminController::class, 'location']);
    Route::get('tour', [AdminController::class, 'tour']);
    Route::get('vehicle', [AdminController::class, 'vehicle']);
    Route::get('bookins-trip-report', [AdminController::class, 'bookingsTripReport']);
    Route::get('bookings-tour-report', [AdminController::class, 'bookingsTourReport']);
    Route::get('chart', [AdminController::class, 'chart']);
    
    // Metodos par users
    Route::get('getUsers', [UserController::class, 'getUsers']);
    Route::get('getProfiles', [UserController::class, 'getProfiles']);
    Route::get('getUserById', [UserController::class, 'getUserById']);
    Route::post('create-user', [UserController::class, 'CreateUser']);
    Route::put('update-user', [UserController::class, 'UpdateUser']);
    Route::put('enabled-disabled-user', [UserController::class, 'EnabledDisableUser']);
    Route::get('get-current-data-user', [UserController::class, 'GetCurrentUser']);
    Route::put('update-current-data-user', [UserController::class, 'UpdateCurrentUser']);
    Route::put('change-password', [UserController::class, 'ChangePassword']);
    Route::get('valid-permision', [UserController::class, 'validPermision']);
    
    // Metodos de zonas / destinos
    Route::get('getZonas', [ZonasController::class, 'getZonas']);
    Route::post('create-zona', [ZonasController::class, 'createZona']);
    Route::get('get-zona-by-id', [ZonasController::class, 'getZonaById']);
    Route::put('update-zona', [ZonasController::class, 'updateZona']);

    // Metodos de locaciones / ubicaciones
    Route::get('get-locations', [UbicacionesController::class , 'getLocations']);
    Route::get('get-location-by-id', [UbicacionesController::class, 'getLocationsByIdZona']);
    Route::post('create-location', [UbicacionesController::class, 'createLocation']);
    Route::put('update-location', [UbicacionesController::class, 'updateLocation']);

    // Metodos de tours
    Route::get('get-tours', [ToursController::class, 'getTours']);
    Route::get('get-tour-by-id', [ToursController::class, 'getTourById']);
    Route::post('save-tour', [ToursController::class, 'saveTour']);
    Route::put('update-tour', [ToursController::class, 'updateTour']);
    Route::get('get-tour-options', [ToursController::class, 'getTourOptions']);

    // Metodos de vehiculos
    Route::get('get-vehicles', [VehiclesController::class, 'getVehicles']);
    Route::post('save-vehicle', [VehiclesController::class, 'saveVehicle']);
    Route::get('get-vehicle-by-id', [VehiclesController::class, 'getVehicleById']);
    Route::put('update-vehicle', [VehiclesController::class, 'updateVehicle']);
    Route::delete('delete-vehicle', [VehiclesController::class, 'deleteVehicle']);

    // Reportes de bookings
    Route::get('get-bookings-trip-report', [BookingsTripController::class, 'getBookinsgTripReport']);
    Route::get('get-type-trip', [BookingsTripController::class, 'getTypeTrip']);
    Route::post('resend-email-trip', [BookingsTripController::class, 'resendEmailTrip']);
    Route::get('get-bookings-tour-report', [BookingsTourController::class, 'getBookingsTourReport']);
    Route::post('resend-email-tour', [BookingsTourController::class, 'resendEmailTour']);
});
