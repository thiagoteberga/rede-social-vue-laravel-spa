<template>
  <span>
    <site-template>
      <span slot="menuesquerdo">
        <img
          src="http://solucoes.prodesp.sp.gov.br/wp-content/uploads/2020/08/LOGIN-SP-1024x797.png"
          alt="Imagem de Login"
          class="responsive-img"
        />
      </span>

      <span slot="principal">
        <card-menu-vue>
          <h2>Atualizar Perfil</h2>
          <div class="input-field col s12">
          <input type="text" id="nome" class="validate" v-model="usuario.name" />
          <label for="nome" class="active">Nome Completo</label>
          </div>
          <div class="input-field col s12">
          <input type="email" id="email" class="validate" v-model="usuario.email" />
          <label for="email" class="active">Email</label>
          </div>

          <div class="file-field input-field col s12">
            <div class="btn light-blue">
              <span>Imagem</span>
              <input type="file" />
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text"  />
            </div>
          </div>

          <div class="input-field col s12">
          <input type="password" id="password" class="validate" v-model="usuario.password"/>
          <label for="password" class="active">Nova Senha</label>
          </div>
          <div class="input-field col s12">
          <input type="password" id="confirm-password" class="validate"  v-model="usuario.password_confirmation"/>
          <label for="confirm-password" class="active">Confirme a Nova Senha</label>
          </div>

          <button class="btn light-blue darken-3" v-on:click="perfil()">Salvar</button>
        </card-menu-vue>
      </span>
    </site-template>
  </span>
</template>

<script>
import SiteTemplate from "@/templates/SiteTemplate";
import CardMenuVue from '@/components/layouts/CardMenuVue'
import axios from "axios";
export default {
  name: "Perfil",
  components: {
    SiteTemplate,
    CardMenuVue
  },
  data() {
    return {
      usuario:{ 
        name: "",
        email: "",
        password: "",
        password_confirmation: ""
      },
      usuarioLogado: ""
    };
  },
  created(){
    console.log('Created.')
    let usuarioSession = sessionStorage.getItem('belvedereUsuario');
    if(usuarioSession){
      this.usuarioLogado = JSON.parse(usuarioSession);
      this.usuario.name = this.usuarioLogado.name;
      this.usuario.email = this.usuarioLogado.email;
    }
  },
  methods: {
    perfil() {
      axios
        .put(`http://127.0.0.1:8000/api/perfil`, {
          name: this.usuario.name,
          email: this.usuario.email,
          password: this.usuario.password,
          password_confirmation: this.usuario.password_confirmation,
        },{"headers":{"authorization":"Bearer "+this.usuarioLogado.token}})
        .then((response) => {
          console.log("Retorno Recebido da API!");
          console.log(response);

          if (response.data.token) {
            console.log("Perfil atualizado com Sucesso");
            console.log(response.data);
            sessionStorage.setItem('belvedereUsuario',JSON.stringify(response.data));
            alert('Perfil atualizado!');
          } else {
            console.log("Erro de Validacao");
            let erros = "";
            for (let erro of Object.values(response.data)) {
              erros += erro + " ";
            }
            alert(erros);
          }
        })
        .catch((e) => {
          alert("Servido indisponível no momento, tente novamente mais tarde!");
          console.log("Erro na Comunicação com a API!");
        });
    },
  },
};
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
