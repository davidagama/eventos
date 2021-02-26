<?php

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

use App\Http\Controllers\EventController;

Route::get('/',  [EventController::class, 'index']); //Index é usado para mostrar todos os registros do BD
Route::get('/events/create',  [EventController::class, 'create']); //Create mostra o formulário de criar registros no BD
Route::get('/events/{id}', [EventController::class, 'show']); //show mostra um dado específico do BD
Route::get('/contact',  [EventController::class, 'open']); //open é gambiarra
Route::post('/events', [EventController::class, 'store']); //store envia dados pro BD
/*'index', 'create' e 'open' são nomes de ACTIONS*/


Route::get('/contact', function () {
    return view('contact');
});
