<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function(Request $request){

    //ver todos os headers da requisição
   // dd($request->headers->all());
    
    //pegar header authorization
    //dd($request->headers->get('Authorization'));

    $response = new Response(json_encode(['msg' => 'Minha primeira resposta de API']));

    //alterando o cabeçalho content type indicando que a resposta é um json
    //atravez do mime type aplication json
    $response->header('Content-Type', 'application/json');

    return $response;
});


Route::namespace('Api')->group(function () {
    //Products Route
    Route::prefix('products')->group(function () {
        Route::get('/', 'ProductController@index');

        Route::get('/{id}', 'ProductController@show');
                                                 //esse middleware faz uma verificação de 
                                                 //autenticação basica, se não tiver 
                                                 //autorizado retorna um 401 unauthorized
                                                 //tem que usar o basic auth do postman
        Route::post('/','ProductController@save')->middleware('auth.basic');
                                 //basic autorization gera um token base 64 com user:password
    
        Route::put('/', 'ProductController@update');
    
        Route::patch('/', 'ProductController@update');
    
        Route::delete('/{id}', 'ProductController@delete');
    });

    Route::resource('/users', 'UserController');
});


