<template>
  <span>
    <login-template>
      <span slot="menuesquerdo">
        <img src="http://solucoes.prodesp.sp.gov.br/wp-content/uploads/2020/08/LOGIN-SP-1024x797.png" alt="Imagem de Login" class="responsive-img">
      </span> 

      <span slot="principal">
        
          <h2>Cadastro</h2>
          
          <input type="text" placeholder="Nome" v-model="usuario.name">
          <input type="text" placeholder="Email" v-model="usuario.email">
          <input type="password" placeholder="Senha" v-model="usuario.password">
          <input type="password" placeholder="Confirme a Senha" v-model="usuario.password_confirmation">
          <button class="btn green" v-on:click="cadastro()">Cadastrar</button>
          <router-link to="/login" class="btn  light-blue darken-3">Já tenho conta</router-link>

      </span>
    </login-template>
  </span>
</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'
export default {
  name: 'Cadastro',
  components: {
    LoginTemplate
  },
  data () {
    return {
      usuario:{name:'',email:'',password:'',password_confirmation:''}
    }
  },
  methods:{cadastro(){
      this.$http.post(this.$urlAPI+`cadastro`, {
        name: this.usuario.name,
        email: this.usuario.email,
        password: this.usuario.password,
        password_confirmation: this.usuario.password_confirmation,
      })
      .then(response => {
          console.log("Retorno Recebido da API!");
          console.log(response);
          if(response.data.status){
              console.log('Cadastro realizado com Sucesso');
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
              console.log('Erro no cadastro, tente novamente mais tarde!');
              alert('Erro no cadastro, tente novamente mais tarde!');
          }
      })
      .catch(e => {
        alert("Servido indisponível no momento, tente novamente mais tarde!")
        console.log("Erro na Comunicação com a API!");
      })
  }}
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
