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
Route::get('/events/create',  [EventController::class, 'create'])->middleware('auth'); //Create mostra o formulário de criar registros no BD
Route::get('/events/{id}', [EventController::class, 'show']); //show mostra um dado específico do BD
Route::get('/contact',  [EventController::class, 'open']); //open é gambiarra
Route::post('/events', [EventController::class, 'store']); //store envia dados pro BD
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth'); //O método deletar no Laravel se chama destroy
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth'); //edit é usado para puxar um reg. no BD para alteração no form
Route::put('/events/update/{id}', [EventController::class, 'update'])->middleware('auth'); //update é usado para fazer de fato atualização do reg. no BD

/*'index', 'create', 'open', 'show' e 'store' e outros são nomes de ACTIONS*/

//->middleware('auth'); ---> Este trecho impede que usuários não cadastrados tenham acesso a estas rotas

/* 
|--------------------------------------------------------------------------
| Sobre a rota: "Route::get('/',  [EventController::class, 'index']);"
|--------------------------------------------------------------------------
|
| Funciona mais ou menos desta maneria: o usuário digita o endereço "localhost:8000/" no seu navegador, por exemplo, para chamar a home page,
| pois o "/" corresponde a home.
| Depois disso, no EventController é disparada a action (ou function) definida na rota, que processa o que estiver dentro dela,
| vai no BD se for preciso e pode passar pelo Model também.
| Depois do processo acima, a view é retornada para o usuário.
|
| Resumindo: geralmente o usuário acessa uma rota, que acessa uma action de um controller,
| que retorna uma view pra ele.
|  
|*/

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');
