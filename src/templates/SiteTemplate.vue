<template>
  <span class="body-span">
    <header>
      <nav-bar-vue color="light-blue darken-3" url="/" logo="Maroto">
          <li v-if="usuario"><router-link to="/">Home</router-link></li>
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
            <card-menu-vue>
              <h3>Amigos</h3>
              <li>Afonso</li>
              <li>Marcio</li>
              <li>Diego</li>
            </card-menu-vue>

          </grid-vue>
          <grid-vue size="s12 m12 l8">
            <slot name="principal" />
          </grid-vue>
        </div>

        
      </div>
    </main>
    
     <footer-vue color="amber darken-1" logo="Logo" title = 'Titulo' copyright = 'Reservado por Parametro' author = 'Thiago Teberga' description = 'Footer personalizado'>
                  <li><a class="grey-text text-lighten-3" href="#!">Link Slot 1</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link Slot 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
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
      usuario: false
    }
  },
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
  },
  methods:{
    sair(){
      sessionStorage.clear();
      this.$store.commit('setUsuario','');
      this.usuario=false;
      this.$router.push('/login');
    }
  }
}
</script>

<style>
</style>