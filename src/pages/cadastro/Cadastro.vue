<template>
  <span>
    <login-template>
      <span slot="menuesquerdo">
        <img src="http://solucoes.prodesp.sp.gov.br/wp-content/uploads/2020/08/LOGIN-SP-1024x797.png" alt="Imagem de Login" class="responsive-img">
      </span> 

      <span slot="principal">
        
          <h2>Cadastro</h2>
          
          <input type="text" placeholder="Nome" value="">
          <input type="text" placeholder="Email" value="">
          <input type="password" placeholder="Senha" value="">
          <input type="password" placeholder="Confirme a Senha" value="">
          <router-link to="/" class="btn green">Cadastrar</router-link>
          <router-link to="/login" class="btn blue">Já tenho conta</router-link>

      </span>
    </login-template>
  </span>
</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'
export default {
  name: 'Login',
  components: {
    LoginTemplate
  },
  data () {
    return {
    }
  }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
