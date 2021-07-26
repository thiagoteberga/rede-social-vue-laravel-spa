<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User; //Importando o MODEL USERS
use Illuminate\Support\Facades\Validator; //Validacao

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
    return "Ok!";
});

Route::post('/cadastro',function (Request $request) {
    $data = $request->all();

    $validacao = Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    if($validacao->fails()){
        return $validacao-> errors();
    };

    $user = User::create([
        'name' => $data['name'], 
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    $user->token = $user->createToken($user->email)->accessToken;

    return $user;
});


Route::post('/login',function (Request $request) {
    $data = $request->all();
    //return $data;

    $validacao = Validator::make($data, [
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'string'],
    ]);

    if($validacao->fails()){
        return $validacao-> errors();
    };

    if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
        $user = auth()->user();
        $user->token = $user->createToken($user->email)->accessToken;
        return $user;
    }else{
        return ['status'=>false,'description'=>'Usuário ou senha inválida.'];
    }

});

Route::middleware('auth:api')->get('/usuario', function (Request $request) {
    return $request->user();
});
