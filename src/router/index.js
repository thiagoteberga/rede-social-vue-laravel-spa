import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/home/Home'
import Usuarios from '@/pages/usuarios/Usuarios'
import Login from '@/pages/login/Login'
import Cadastro from '@/pages/cadastro/Cadastro'
import Perfil from '@/pages/perfil/Perfil'
import Pagina from '@/pages/pagina/Pagina'

Vue.use(Router)

export default new Router({
  base: process.env.ROUTER_BASE,
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/usuarios',
      name: 'Usuarios',
      component: Usuarios
    },
    {
      path: '/pagina/:id/:nome?', //Interrogacao eh nao obrigatorio
      name: 'Pagina',
      component: Pagina
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/cadastro',
      name: 'Cadastro',
      component: Cadastro
    },
    {
      path: '/perfil',
      name: 'Perfil',
      component: Perfil
    }
  ]
})
