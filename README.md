# Rede Social com Vue JS e API Laravel

> Plataforma criada durante o curso.

## Curso de SPA com Vue JS e API Laravel
- [x] Veja o curso [clicando aqui](https://www.udemy.com/course/spa-com-vue-js/).

# Identar com o VSCode:
- Windows: shift + alt + f
- Mac: shift + option + f
- Linux: ctrl + shift + i

# Ferramentas Utilizadas:
## Composer:
https://getcomposer.org/download/

## NodeJS:
https://nodejs.org/en/download/

## Git:
https://git-scm.com/downloads

## Cmder:
https://cmder.net/

## Postman:
https://www.getpostman.com/

## Pacote de Icones:
https://www.flaticon.com/br/packs/learning-265

## Criar o Projeto com Vue:
https://cli.vuejs.org/guide/prototyping.html

`npm install -g @vue/cli @vue/cli-service-global`


# Comandos para a Build de Produção:


``` bash
# install dependencies
npm install

# serve with hot reload at localhost:8080
npm run dev

# build for production with minification
npm run build

# build for production and view the bundle analyzer report
npm run build --report
```



# (Configuração do Laravel 8.0) 
## API com Laravel

## Instalar o Laravel
`composer create-project --prefer-dist laravel/laravel webservice`

## Configurar o banco de dados MySQL, ajusta o arquivo "webservice\.env"
`composer require laravel/passport`

## Configurar o banco de dados ...
## Se rodar o :fresh será necessário rodar o passport novamente.
`php artisan migrate`
`php artisan passport:install`

## Colocar no User:
use Laravel\Passport\HasApiTokens;
use HasApiTokens, Notifiable;

## Colocar no "config/auth"
'api' => [
    'driver' => 'passport',
    'provider' => 'users',
],

## Aula 27
`https://laravel.com/docs/7.x/authentication`

## Instalar o Laravel Ui
`composer require laravel/ui:^3.x`

## Instalar o Modulo de Autenticacao
`php artisan ui vue --auth`

## Instalar o Axios
`npm install axios --save`

## Rodar o server Laravel
`php artisan serve`

## Adicionar uma Migration
``` bash
# Criar uma Migration para Adicionar o Campo IMAGEM
php artisan make:migration add_image_table_users --table=users

# Rodar a Migration para que o Laravel efetive a alteracao no Banco de Dados
php artisan migrate`
```

## Adicionar um Controller
``` bash
# Criar um Controller
php artisan make:controller Usuario/UsuarioController
php artisan make:controller Conteudo/ConteudoController
```

## Adicionar um Controller
``` bash
# Instalar o Cors
#Access to XMLHttpRequest at 'http://localhost:8000/api/login' from origin 'http://localhost:8080' has been blocked by CORS policy.
composer require barryvdh/laravel-cors
```

## Tabelas
``` bash
# Models no Singular
# Tabelas no Plural

#users
-email
-nome
-data_verificacao_email
-senha
-data-criacao
-data-atualizacao
-imagem

#conteudos
-id
-user_id
-titulo
-texto
-imagem
-link
-data

#comentarios
-coment_id
-conteudo_id
-user_id
-texto
-data

#amigos
-user_id
-amigo_id

#curtidas
-user_id
-conteudo_id

```

## Comando úteis no Laravel
``` bash
#Criando Models e Migrations
php artisan make:model Conteudo -m
php artisan make:model Comentario -m
php artisan make:migration create_amigos_table --create=amigos
php artisan make:migration create_curtidas_table --create=curtidas

#Criar as Migracoes
php artisan migrate

#Recriar as Migracoes (Limpa as Tabelas)
php artisan migrate:fresh


php artisan migrate:rollback
php artisan migrate:status


#Utilizando o Tinker para Gerenciar os Dados no Laravel
php artisan tinker
App\Models\User::all();
$listaConteudos = App\Models\Conteudo::all();
App\Models\Conteudo::find(17)->delete();
