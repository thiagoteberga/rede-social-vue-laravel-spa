# Rede Social com Vue JS e API Laravel

> Plataforma criada durante o curso.

## Curso de SPA com Vue JS e API Laravel
- [x] Veja o curso [clicando aqui](https://www.udemy.com/course/spa-com-vue-js/).


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

