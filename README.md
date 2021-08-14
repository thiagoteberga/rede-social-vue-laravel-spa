# Rede Social com Vue JS e API Laravel

##  Plataforma criada durante o curso.
Veja o projeto finalizado [clicando aqui](https://marinasilva.adv.br/rede_social/).

#  Prints do Projeto:

## Login:
![alt text](https://raw.githubusercontent.com/thiagoteberga/vue-laravel-spa-course/main/webservice/public/prints/print-1.jpg)

## Home:
![alt text](https://raw.githubusercontent.com/thiagoteberga/vue-laravel-spa-course/main/webservice/public/prints/print-2.jpg)

## Alterar Perfil:
![alt text](https://raw.githubusercontent.com/thiagoteberga/vue-laravel-spa-course/main/webservice/public/prints/print-3.jpg)

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

## SLUG para Links Amigaveis
https://www.npmjs.com/package/slug

`npm install -g @vue/cli @vue/cli-service-global`


# Comandos para a Build de Produção:

``` bash
# install dependencies
npm install

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

## Instalar o SLUG
npm install slug --save

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

## Configurar o Cors (Apenas se apresentar o erro de Cors)
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
```


``` bash
#Utilizando o Tinker para Gerenciar os Dados no Laravel
php artisan tinker
App\Models\User::all();
$listaConteudos = App\Models\Conteudo::all();
App\Models\Conteudo::find(17)->delete();
```


``` bash
# Configurando o Ambiente Compartilhado de Hospedagem para Aceitar o Laravel (PASTA RAIZ DO LARAVEL):
https://www.youtube.com/watch?v=fkwhtu0H5EU

 wget https://getcomposer.org/installer
 ls -la
 php installer
 rm -rf installer
 composer create-project laravel/laravel laravel-rede-social

 mv public_html public_html_bkp
 ln -s laravel-rede-social/public public_html
 cd laravel-rede-social
 find * -type d -exec chmod 755 {} \;
 find * -type f -exec chmod 644 {} \;
 cd ..
 chmod 755 laravel-rede-social
```


``` bash
# Configurando o Ambiente Compartilhado de Hospedagem para Aceitar o Laravel (PASTA RAIZ DO VUE e Outra do Laravel):

## Como Configurar o Linux para a versão correta do PHP:
https://suporte.hostgator.com.br/hc/pt-br/articles/360006664913-Como-alterar-a-vers%C3%A3o-do-PHP#.htaccess

## Dicas de Configuração
https://pt.stackoverflow.com/questions/91795/lista-de-diret%c3%b3rios-do-projeto-em-laravel-%c3%a9-exibida-ao-inv%c3%a9s-de-executar-a-aplic/91799#91799

 wget https://getcomposer.org/installer
 ls -la
 php installer
 rm -rf installer
 composer create-project laravel/laravel laravel-rede-social

## Criar atalho para a pasta do Laravel
ln -s rede_social/webservice/public backend

## Instalar a parte de Banco do Laravel
composer require laravel/passport
php artisan passport:install

composer require laravel/ui:3.x


# Erro de API_TOKEN:
/public_html/rede_social/webservice/config/auth.php
php artisan ui vue --auth

No campo API alterar o 'driver' => 'passport'
webservice/config/auth.php
```

``` bash
## Traducao erros Portugues
https://github.com/lucascudo/laravel-pt-BR-localization
/public_html/rede_social/webservice/resources/lang
```



