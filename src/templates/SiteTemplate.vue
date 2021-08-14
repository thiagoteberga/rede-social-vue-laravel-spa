<template>
  <span class="body-span">
    <header>
      <nav-bar-vue color="light-blue darken-3" url="/">
          <li v-if="usuario"><router-link to="/">Home</router-link></li>
          <li v-if="usuario"><router-link to="/usuarios">Usuários</router-link></li>
          <li v-if="!usuario"><router-link to="/login">Entrar</router-link></li>
          <li v-if="!usuario"><router-link to="/cadastro">Cadastrar</router-link></li>
          <li v-if="usuario"><router-link to="/perfil">{{usuario.name}}</router-link></li>
          <li v-if="usuario"><a v-on:click="sair()">Sair</a></li>
      </nav-bar-vue>
    </header>

    <main>
      <div class="container">

        <div class="row">
          <grid-vue size="s12 m12 l4">

            <card-menu-vue>
              <slot name="menuesquerdo" />
            </card-menu-vue>
            <card-menu-vue v-if="perfil">
              <h3>Seguindo ({{qtseguindo}})</h3>
              <slot name="menuesquerdoseguindo" />
            </card-menu-vue>
            <card-menu-vue v-if="perfil">
              <h3>Seguidores ({{qtseguidores}})</h3>
              <slot name="menuesquerdoseguidores" />
            </card-menu-vue>

          </grid-vue>
          <grid-vue size="s12 m12 l8">
            <slot name="principal" />
          </grid-vue>
        </div>

        
      </div>
    </main>
    
     <footer-vue color="amber darken-1" logo="Redes Sociais" title = 'Rede Social com Vue.JS e Laravel' copyright = 'Todos os direitos reservados' author = 'Thiago Teberga' description = 'Projeto para Aprendizado'>
                  <li><a class="grey-text text-lighten-3" href="https://www.linkedin.com/in/thiagoteberga/">Linkedin</a></li>
                  <li><a class="grey-text text-lighten-3" href="https://github.com/thiagoteberga/">GitHub</a></li>
                  <li><a class="grey-text text-lighten-3" href="https://www.facebook.com/thiiteberga/">Facebook</a></li>
                  <li><a class="grey-text text-lighten-3" href="https://www.instagram.com/thiagoteberga">Instagram</a></li>
     </footer-vue>

  </span>
</template>

<script>
import NavBarVue from '@/components/layouts/NavBarVue'
import FooterVue from '@/components/layouts/FooterVue'
import GridVue from '@/components/layouts/GridVue'
import CardMenuVue from '@/components/layouts/CardMenuVue'
export default {
  name: 'SiteTemplate',
  data(){
    return {
      usuario: false,
      perfil: true
    }
  },
  props:['qtseguindo','qtseguidores'],
  components: {
    NavBarVue,
    FooterVue,
    GridVue,
    CardMenuVue
  },
  created(){
    //Redireciona se nao estiver logado.
    let usuarioSession = this.$store.getters.getUsuario;
    if(usuarioSession){
      this.usuario = this.$store.getters.getUsuario;
    }else{
      this.$router.push('/login');
    }

    if(this.$route.name == "Perfil"){
      this.perfil = false;
    }else{
      this.perfil = true;
    }


  },
  mounted() {
      M.AutoInit(); // That way, it is only initialized when the component is mounted
  },
  methods:{
    sair(){
      localStorage.clear();
      this.$store.commit('setUsuario','');
      this.usuario=false;
      this.$router.push('/login');
    }
  }
}
</script>

<style>
</style>