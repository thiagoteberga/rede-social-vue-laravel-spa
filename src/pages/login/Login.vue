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
          <button class="btn  light-blue darken-3" v-on:click="login()">Entrar</button>
          <router-link to="/cadastro" class="btn  light-blue">Criar Conta</router-link>

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
  methods:{login(){
      this.$http.post(this.$urlAPI+`login`, {
        email: this.usuario.email,
        password: this.usuario.password
      })
      .then(response => {
          console.log("Retorno Recebido da API!");
          console.log(response);
          if(response.data.status){
              console.log('Login com Sucesso');
              this.$store.commit('setUsuario',response.data.usuario);
              sessionStorage.setItem('belvedereUsuario',JSON.stringify(response.data.usuario));
              this.$router.push('/');
          }else if(response.data.status == false && response.data.validacao == true){
              console.log('Erro de Validacao');
              let erros = '';
              for (let erro of Object.values(response.data.erros)){
                erros += erro +" ";
              }
              alert(erros);
          }else{
              console.log('Login nao Existe');
              alert('Usuário ou senha inválidos!');
          }
      })
      .catch(e => {
        alert("Servido indisponível no momento, tente novamente mais tarde!")
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
