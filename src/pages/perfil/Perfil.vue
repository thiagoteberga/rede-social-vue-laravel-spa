<template>
  <span>
    <site-template>
      <span slot="menuesquerdo">
        <img
          :src="this.usuario.imagem"
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
              <input type="file" v-on:change="salvaImagem" />
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" />
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
        password_confirmation: "",
        imagem: ""
      },
      usuarioLogado: ""
    };
  },
  created(){
    //console.log('Created.')
    let usuarioSession = this.$store.getters.getUsuario;
    if(usuarioSession){
      this.usuarioLogado = this.$store.getters.getUsuario;
      this.usuario.name = this.usuarioLogado.name;
      this.usuario.email = this.usuarioLogado.email;
      this.usuario.imagem = this.usuarioLogado.imagem;
    }
  },
  methods: {
    salvaImagem(e){
      let imageFile = e.target.files || e.dataTransfer.files;
      //e.target.files -> Quando é buscado pelo browser
      //e.dataTransfer.files -> Funcao arrasta e solta

      if(!imageFile.length){
        return;
      }

      let reader = new FileReader();
      reader.onloadend = (e) => {
        this.usuario.imagem = e.target.result;
      };

      reader.readAsDataURL(imageFile[0]);
      //console.log(this.usuario.imagem);
      

      
    },
    perfil() {
      this.$http
        .put(this.$urlAPI+`perfil`, {
          name: this.usuario.name,
          email: this.usuario.email,
          password: this.usuario.password,
          password_confirmation: this.usuario.password_confirmation,
          imagem: this.usuario.imagem,
        },{"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
        .then((response) => {
          console.log("Retorno Recebido da API!");
          console.log(response);

          if (response.data.status) {
            console.log("Perfil atualizado com Sucesso");
            //console.log(response.data);
            this.usuario = response.data.usuario;
            this.$store.commit('setUsuario',response.data.usuario);
            sessionStorage.setItem('belvedereUsuario',JSON.stringify(this.usuario));
            alert('Perfil atualizado!');

          } else if (response.data.status == false && response.data.validacao == true){
            console.log("Erro de Validacao");
            let erros = "";
            for (let erro of Object.values(response.data.erros)) {
              erros += erro + " ";
            }
            alert(erros);

          } else {
            alert('Erro Generico');
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
