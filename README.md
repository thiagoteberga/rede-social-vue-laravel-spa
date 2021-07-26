# Learning VueJS

> Learning how to work with VueJS and Laravel

## Build Setup

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

For a detailed explanation on how things work, check out the [guide](http://vuejs-templates.github.io/webpack/) and [docs for vue-loader](http://vuejs.github.io/vue-loader).


# (Laravel 5.5) 
## API com Laravel

## Instalar o Laravel
composer create-project --prefer-dist laravel/laravel webservice "5.5.*"

composer require laravel/passport

configurar o banco de dados ...

php artisan migrate

php artisan passport:install

colocar no User:
use Laravel\Passport\HasApiTokens;
use HasApiTokens, Notifiable;

e o config/auth

'api' => [
    'driver' => 'passport',
    'provider' => 'users',
],

pronto...

criar rotas de cadastro e de login e depois testar o acesso com token

Baixar o Postman:
https://www.getpostman.com/







# (Laravel 8.0) 
## API com Laravel

## Instalar o Laravel

`composer create-project --prefer-dist laravel/laravel webservice`

composer require laravel/passport

Configurar o banco de dados MySQL, ajusta o arquivo "webservice\.env"

php artisan migrate

php artisan passport:install

`
Client ID: 1
Client secret: ARSYJ1hgcBTJF8ktUNj7NCaKupgjNFzcZnZmP4WT
Password grant client created successfully.
Client ID: 2
Client secret: WdWkQhDmCiJlN3VuRL2gPzDxLh4ZGi5Ou6zKpPAN
`

colocar no "webservice\app\Models\User.php":
use Laravel\Passport\HasApiTokens;
use HasApiTokens, Notifiable;

e o config/auth

'api' => [
    'driver' => 'passport',
    'provider' => 'users',
],

pronto...

//Aula 27
//https://laravel.com/docs/7.x/authentication

composer require laravel/ui:^3.x

php artisan ui vue --auth

npm install axios --save

php artisan serve

Criar rotas de cadastro e de login e depois testar o acesso com token

Baixar o Postman:
https://www.getpostman.com/