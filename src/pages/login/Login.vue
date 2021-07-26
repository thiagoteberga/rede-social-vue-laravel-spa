<template>
  <span>
    <login-template>
      <span slot="menuesquerdo">
        <img src="http://solucoes.prodesp.sp.gov.br/wp-content/uploads/2020/08/LOGIN-SP-1024x797.png" alt="Imagem de Login" class="responsive-img">
      </span> 

      <span slot="principal">
        
          <h2>Login</h2>
          
          <input type="text" placeholder="Email" v-model="usuario.email">
          <input type="password" placeholder="*******" v-model="usuario.password">
          <button class="btn green" v-on:click="login()">Entrar</button>
          <router-link to="/cadastro" class="btn blue">Criar Conta</router-link>

      </span>
    </login-template>
  </span>
</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'
import axios from 'axios';
export default {
  name: 'Login',
  components: {
    LoginTemplate
  },
  methods:{login(){
      axios.post(`http://127.0.0.1:8000/api/login`, {
        email: this.usuario.email,
        password: this.usuario.password
      })
      .then(response => {
        console.log("Retorno Recebido da API!");
        console.log(response);
      })
      .catch(e => {
        this.errors.push(e)
        console.log("Erro na Comunicação com a API!");
      })
  }},
  data () {
    return {
      usuario:{email:'',password:''}
    }
  }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
