<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'imagem'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //https://laravel.com/docs/8.x/eloquent-relationships#one-to-many
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    //https://laravel.com/docs/8.x/eloquent-relationships#one-to-many
    public function conteudos()
    {
        return $this->hasMany(Conteudo::class);
    }

    //https://laravel.com/docs/8.x/eloquent-relationships#many-to-many
    public function curtidas()
    {
        return $this->belongsToMany(Conteudo::class, 'curtidas', 'user_id', 'conteudo_id');
    }

    //https://laravel.com/docs/8.x/eloquent-relationships#many-to-many
    public function amigos()
    {
        return $this->belongsToMany(User::class, 'amigos', 'user_id', 'amigo_id');
    }

    public function seguidores()
    {
        return $this->belongsToMany(User::class, 'amigos', 'amigo_id', 'user_id');
    }

    public function getImagemAttribute($value)
    {
        return asset($value);
    }
}
