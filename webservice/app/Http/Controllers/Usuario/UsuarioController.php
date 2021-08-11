<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator; //Validacao
use Illuminate\Support\Facades\Hash; //Senhas com HASH
use App\Models\User; //Importando o MODEL USERS
use Illuminate\Validation\Rule; //Validacao Alteracao de Email

class UsuarioController extends Controller
{
    public function login(Request $request){
        $data = $request->all();
        //return $data;
    
        $validacao = Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
            //'password' => ['required', 'string','min:6'],
        ]);
    
        if($validacao->fails()){
            return ['status'=>false,'validacao'=>true,'erros'=> $validacao-> errors()];
        };
    
        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
            $user = auth()->user();
            $user->token = $user->createToken($user->email)->accessToken;
            //$user->imagem = asset($user->imagem);
            return ['status'=>true, 'usuario'=> $user];
        }else{
            return ['status'=>false,'description'=>'Usuário ou senha inválida.'];
        }
    }

    public function cadastro(Request $request){
        $data = $request->all();

        $validacao = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    
        if($validacao->fails()){
            return ['status'=>false,'validacao'=>true,'erros'=> $validacao-> errors()];
        };
        
        $imagem = "/profiles/default.png";
    
        $user = User::create([
            'name' => $data['name'], 
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'imagem' => $imagem,
        ]);
    
        $user->token = $user->createToken($user->email)->accessToken;
        //$user->imagem = asset($user->imagem);
        return ['status'=>true, 'usuario'=> $user];
    }

    public function usuario(Request $request){
        return $request->user();
    }

    public function perfil(Request $request){
        $user = $request->user();
        $data = $request->all();

        if(isset($data['password'])){
            $validacao = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($user->id)],
                'password' => ['required', 'string','min:8','confirmed'],
            ]);
            
            if($validacao->fails()){
                return ['status'=>false,'validacao'=>true,'erros'=> $validacao-> errors()];
            };

            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);

            } else {
                $validacao = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($user->id)],
            ]);
            if($validacao->fails()){
                return ['status'=>false,'validacao'=>true,'erros'=> $validacao-> errors()];
            };
            $user->name = $data['name'];
            $user->email = $data['email'];
        }

        
        //VALIDACAO DA IMAGEM
        if(isset($data['imagem']) && strpos($data['imagem'],"profiles") == false ){ //PRECISA CORRIGIR

            Validator::extend('base64image', function ($attribute, $value, $parameters, $validator) {
                $explode = explode(',', $value);
                $allow = ['png', 'jpg', 'svg','jpeg'];
                $format = str_replace(
                    [
                        'data:image/',
                        ';',
                        'base64',
                    ],
                    [
                        '', '', '',
                    ],
                    $explode[0]
                );
                // check file format
                if (!in_array($format, $allow)) {
                    return false;
                }
                // check base64 format
                if (!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $explode[1])) {
                    return false;
                }
                return true;
            });

            $valiacao = Validator::make($data, [
                'imagem' => 'base64image',

            ],['base64image'=>'Imagem inválida, por favor envie uma imagem do formato PNG, JPG, JPEG ou SVG!']);


            if($valiacao->fails()){
                return ['status'=>false,'validacao'=>true,'erros'=> $validacao-> errors()];
            }

            $time = time();
            $diretorioPai = 'profiles';
            $diretorioImagem = $diretorioPai.DIRECTORY_SEPARATOR.'profile_id'.$user->id;
            $ext = substr($data['imagem'], 11, strpos($data['imagem'], ';') - 11);
            //return [$ext];
            $urlImagem = $diretorioImagem.DIRECTORY_SEPARATOR.$time.'.'.$ext;
            //return [$urlImagem];
            $file = str_replace('data:image/'.$ext.';base64,','',$data['imagem']);
            //return [$file];
            $file = base64_decode($file);

            if(!file_exists($diretorioPai)){
                mkdir($diretorioPai,0700);
            }

            if($user->imagem){
                $imgUser = str_replace(asset('/'),'',$user->imagem);

                if(file_exists($imgUser)){
                    unlink($imgUser);
                }
            }

            if(!file_exists($diretorioImagem)){
                mkdir($diretorioImagem,0700);
            }

            file_put_contents($urlImagem,$file);

            $user->imagem = $urlImagem;
        }

        $user->save();

        //$user->imagem = asset($user->imagem);
        $user->token = $user->createToken($user->email)->accessToken;
        return ['status'=>true, 'validacao'=>false, 'usuario'=> $user];
    }

    public function seguir(Request $request){
        $user = $request->user();
        $amigo = User::find($request->id);
        if($amigo){
            $user -> amigos() -> toggle($amigo->id);
            return ['status'=>true, 'validacao'=>false, 'amigos'=> $user -> amigos];
        }else{
            return ['status'=>false,'validacao'=>true,'erros'=> 'Usuário inexistente!'];
        }
    }

}