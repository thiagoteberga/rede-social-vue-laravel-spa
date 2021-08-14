// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import axios from "axios";
import Vuex from 'vuex'
import slug from 'slug'
import 'materialize-css/dist/css/materialize.min.css'
import 'materialize-css/dist/js/materialize.min.js'

//Opcao de SLUG sem Biblioteca Externação
/*
let slug2 = function(string){
  string = string.replace(' ', '_');
  return string;
}
*/

Vue.use(Vuex)
Vue.config.productionTip = false
Vue.prototype.$http = axios
//Vue.prototype.$urlAPI = 'http://127.0.0.1:8000/api/'
Vue.prototype.$urlAPI = 'https://marinasilva.adv.br/backend/api/'
Vue.prototype.$slug = slug


var store = {
  state:{
    usuario: localStorage.getItem('usuarioLogadoSessao') ? JSON.parse(localStorage.getItem('usuarioLogadoSessao')) : null,
    conteudosLinhaTempo: [],
    usuariosCadastrados: [],
  },
  getters:{
    getUsuario: state =>{
      return state.usuario;
    },
    getToken: state =>{
      return state.usuario.token;
    },
    getConteudosLinhaTempo: state =>{
      return state.conteudosLinhaTempo;
    },
    getUsuariosCadastrados: state =>{
      return state.usuariosCadastrados;
    },
  },
  mutations:{
    setUsuario(state,n){
      state.usuario = n;
    },
    setConteudosLinhaTempo(state,n){
      state.conteudosLinhaTempo = n;
    },
    setUsuariosCadastrados(state,n){
      state.usuariosCadastrados = n;
    },
    //Aula 80
    setPaginacaoConteudosLinhaTempo(state,lista){
      for(let item of lista){
        state.conteudosLinhaTempo.push(item);
      }
    }
  }
};

Vue.directive('scroll', {
  inserted: function (el, binding) {
    let f = function (evt) {
      if (binding.value(evt, el)) {
        window.removeEventListener('scroll', f)
      }
    }
    window.addEventListener('scroll', f)
  }
})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  store: new Vuex.Store(store),
  router,
  components: { App },
  template: '<App/>'
})
