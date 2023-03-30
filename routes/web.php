<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebController;
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
Route::get('/motorbusqueda', [WebController::class, 'motorbusqueda']);
Route::post('/changelenguage', [WebController::class, 'ChangeLenguage']);
