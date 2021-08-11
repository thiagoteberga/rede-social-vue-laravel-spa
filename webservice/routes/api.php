<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Conteudo;
use App\Models\Comentario;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
| http://127.0.0.1:8000/teste
*/

Route::get('/teste',function (Request $request) {
    //return "Ok!";
    
    $user = User::find(1);
    $user2 = User::find(2);
    $user3 = User::find(3);

    //dd(Conteudo::all()); //Lista todos os conteudos

     //Add Comentario
     /*
     $conteudo = Conteudo::find(14);
     $user -> comentarios() -> create([
         'conteudo_id'=>$conteudo->id,
         'texto'=>'Texto Comentario - Show de Bola!',
         'data'=>date('Y-m-d H:i:s')
     ]);
     */

    /*
    // Apagar Conteudos
    $conteudos = Conteudo::all();
    foreach ($conteudos as $key => $value) {
        $value->delete();
    }
    */

    /*
    $user -> conteudos() -> create([
        'titulo'=>'Conteúdo Um',
        'texto'=>'Texto Teste',
        'imagem'=>'URL MAROTO',
        'link'=>'LINK MAROTO',
        'data'=>date('Y-m-d')
    ]);
    return $user->conteudos;
    */

    //Adicionar Amigo
    //$user -> amigos() -> attach($user2->id);

    //Remover Amigo
    //$user -> amigos() -> detach($user2->id);

    //Adicionar e Remover através da mesma função
    //$user -> amigos() -> toggle($user2->id);
    //return $user->amigos;

    /*
    //Adicionar e Remover Curtidas
    $conteudo = Conteudo::find(1);
    $user -> curtidas() -> toggle($conteudo->id);
    //return $conteudo->curtidas->count();
    return $conteudo->curtidas;
    */

    /*
    //Add Comentario
    $conteudo = Conteudo::find(1);
    $user -> comentarios() -> create([
        'conteudo_id'=>$conteudo->id,
        'texto'=>'Texto Comentario',
        'data'=>date('Y-m-d')
    ]);
    $user2 -> comentarios() -> create([
        'conteudo_id'=>$conteudo->id,
        'texto'=>'Texto Comentario Usuario 2',
        'data'=>date('Y-m-d')
    ]);
    $user3 -> comentarios() -> create([
        'conteudo_id'=>$conteudo->id,
        'texto'=>'Texto Comentario Usuario 3',
        'data'=>date('Y-m-d')
    ]);
    return $conteudo->comentarios;
    */
});

Route::post('/cadastro','App\Http\Controllers\Usuario\UsuarioController@cadastro');
Route::post('/login','App\Http\Controllers\Usuario\UsuarioController@login');
Route::middleware('auth:api')->get('/usuario','App\Http\Controllers\Usuario\UsuarioController@usuario');
Route::middleware('auth:api')->put('/perfil','App\Http\Controllers\Usuario\UsuarioController@perfil');
Route::middleware('auth:api')->post('/conteudo/adicionar','App\Http\Controllers\Conteudo\ConteudoController@adicionar');
Route::middleware('auth:api')->get('/conteudo/lista','App\Http\Controllers\Conteudo\ConteudoController@lista');
Route::middleware('auth:api')->put('/conteudo/curtir/{id}','App\Http\Controllers\Conteudo\ConteudoController@curtir');
Route::middleware('auth:api')->put('/conteudo/comentar/{id}','App\Http\Controllers\Conteudo\ConteudoController@comentar');

Route::middleware('auth:api')->get('/conteudo/pagina/lista/{id}','App\Http\Controllers\Conteudo\ConteudoController@pagina');

Route::middleware('auth:api')->post('/usuario/seguir','App\Http\Controllers\Usuario\UsuarioController@seguir');