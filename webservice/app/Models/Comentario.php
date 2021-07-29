<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'conteudo_id',
        'texto',
        'data'
    ];

    //https://laravel.com/docs/8.x/eloquent-relationships#one-to-many-inverse
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //https://laravel.com/docs/8.x/eloquent-relationships#one-to-many-inverse
    public function conteudo()
    {
        return $this->belongsTo(Conteudo::class);
    }

    //$user->comentarios()->create([]);
}
