<?php

namespace App\Http\Controllers\Conteudo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conteudo;
use Illuminate\Support\Facades\Validator; //Validacao

class ConteudoController extends Controller
{
    public function lista(Request $request){

        $conteudos = Conteudo::with('user')->orderBy('data','DESC')->paginate(5);
        $user = $request->user();

        foreach ($conteudos as $key => $conteudo) {
            $conteudo->total_curtidas = $conteudo->curtidas->count();
            $curtiu = $user->curtidas()->find($conteudo->id);
            if($curtiu){
                $conteudo->curtiu_conteudo = true;
            }else{
                $conteudo->curtiu_conteudo = false;
            }
        }

        return ['status'=>true, 'conteudos'=> $conteudos];
        
    }

    public function adicionar(Request $request){

        $data = $request->all();
        $user = $request->user();
        //return ['status'=>true, 'conteudos'=> $data];

        //Validacao
        $validacao = Validator::make($data, [
            'titulo' => ['required', 'string', 'max:300'],
            'texto' => ['required', 'string', 'max:2000'],
        ]);
        
        if($validacao->fails()){
            return ['status'=>false,'validacao'=>true,'erros'=> $validacao-> errors()];
        };

        $conteudo = new Conteudo;

        $conteudo->titulo = $data['titulo'];
        $conteudo->texto = $data['texto'];
        $conteudo->imagem = $data['imagem'] ? $data['imagem'] : '#';
        $conteudo->link = $data['link'] ? $data['link'] : '#';
        $conteudo->data = date('Y-m-d H:i:s');
            
        $user -> conteudos() -> save($conteudo);
        
        $conteudos = Conteudo::with('user')->orderBy('data','DESC')->paginate(5);
        
        return ['status'=>true, 'conteudos'=> $conteudos];
        
    }

    public function curtir($id, Request $request){

        $conteudo = Conteudo::find($id);
        if($conteudo){
            $user = $request->user();
            $user -> curtidas() -> toggle($conteudo->id);
            //return $conteudo->curtidas->count();
    
            return ['status'=>true, 
                    'curtidas'=> $conteudo->curtidas->count(),
                    'lista' => $this->lista($request)];
        } else {
            return ['status'=>false,'validacao'=>true,'erros'=> 'Conteúdo não exite!'];
        }
        
    }
}
