<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'texto',
        'imagem',
        'link',
        'data'
    ];

    //https://laravel.com/docs/8.x/eloquent-relationships#one-to-many-inverse
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //https://laravel.com/docs/8.x/eloquent-relationships#one-to-many
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    //https://laravel.com/docs/8.x/eloquent-relationships#many-to-many
    public function curtidas()
    {
        return $this->belongsToMany(User::class, 'curtidas', 'conteudo_id', 'user_id');
    }
}
