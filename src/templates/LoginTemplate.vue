<template>
  <span class="body-span">
    <header>
      <nav-bar-vue color="light-blue darken-3" url="/">
          <li v-if="!usuario"><router-link to="/login">Entrar</router-link></li>
          <li v-if="!usuario"><router-link to="/cadastro">Cadastrar</router-link></li>
      </nav-bar-vue>
    </header>

    <main>
      <div class="container">

        <div class="row">
          <grid-vue size="s12 m12 l8">
          <card-menu-vue>
            <slot name="menuesquerdo"/>
          </card-menu-vue>
          </grid-vue>
          <grid-vue size="s12 m12 l4">
          <card-menu-vue>
            <slot name="principal"/>
          </card-menu-vue>
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
    //console.log('Created.')
    let usuarioSession = this.$store.getters.getUsuario;
    if(usuarioSession){
      this.usuario = this.$store.getters.getUsuario;
      this.$router.push('/');
    }
  },
  mounted() {
      M.AutoInit(); // That way, it is only initialized when the component is mounted
  }
}
</script>

<style>
</style>