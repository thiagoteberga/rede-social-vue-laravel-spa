<template>
  <site-template :qtseguindo="seguindo.length" :qtseguidores="seguidores.length">

    <span slot="menuesquerdo">
      <div class="row valign-wrapper">
        <grid-vue size="4">
          <router-link :to="'/pagina/'+this.usuarioLogado.id+'/'+$slug(this.nomeUsuarioLogado,{lower: true})">
            <img :src="this.usuarioLogado.imagem" alt="this.usuarioLogado.name" class="circle responsive-img"> <!-- notice the "circle" class -->
          </router-link>
        </grid-vue>
        <grid-vue size="8">
          <span class="black-text">
            <router-link :to="'/pagina/'+this.usuarioLogado.id+'/'+$slug(this.nomeUsuarioLogado,{lower: true})">
              <h5>{{this.usuarioLogado.name}}</h5>
            </router-link>
            O GG Easy é uma rede social em que os usuários postam comentários, compartilham fotos e links para notícias.
          </span>
        </grid-vue>
      </div>
    </span>

    <span slot="menuesquerdoseguindo">
      <router-link v-for="item in this.seguindo" :key="item.id" :to="'/pagina/'+item.id+'/'+$slug(item.name,{lower: true})">
        <li>{{item.name}}</li>
      </router-link>
      <li v-if="!seguindo.length">Nenhum Usuário</li>
    </span>
    <span slot="menuesquerdoseguidores">
      <router-link v-for="item in this.seguidores" :key="item.id" :to="'/pagina/'+item.id+'/'+$slug(item.name,{lower: true})">
        <li>{{item.name}}</li>
      </router-link>
      <li v-if="!seguidores.length">Nenhum Usuário</li>
    </span>

    <span slot="principal">
      <card-usuario-vue v-for="item in listaUsuarios" :key="item.id"
        :id="item.id"
        :userid="item.id"
        :perfil="item.imagem"
        :nome="item.name"
        :email="item.email">
      </card-usuario-vue>

    </span>
  </site-template>
</template>

<script>
import CardUsuarioVue from '@/components/social/CardUsuarioVue'
import PublicarConteudoVue from '@/components/social/PublicarConteudoVue'
import GridVue from '@/components/layouts/GridVue'
import SiteTemplate from '@/templates/SiteTemplate'
export default {
  name: 'Usuarios',
  components: {
    CardUsuarioVue,
    PublicarConteudoVue,
    SiteTemplate,
    GridVue
  },  
  data () {
    return {
      usuarioLogado: '',
      seguindo: [],
      seguidores: [],
      nomeUsuarioLogado: '' //Para nao dar erro ao carregar o Slug
    }
  },
  created(){
    this.atualizaPagina();
  },
  watch:{
    '$route':'atualizaPagina'
  },
  methods: {
    atualizaPagina(){
      let usuarioSession = this.$store.getters.getUsuario;
      if(usuarioSession){
        this.usuarioLogado = this.$store.getters.getUsuario;

        this.$http
        .get(this.$urlAPI+`usuario/lista`, {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
        .then((response) => {
          console.log("Retorno Recebido da API Lista!");
          console.log(response);

          if(response.status){
            this.$store.commit('setUsuariosCadastrados',response.data.usuarios);
            this.nomeUsuarioLogado = this.usuarioLogado.name;
            console.log(response.data.usuarios);
            console.log("Entrou");
            
            //Retorna Lista de Seguidores
            this.$http
            .get(this.$urlAPI+`usuario/meusseguidores`, {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
            .then((response) => {
              console.log("Retorno Recebido da API!");
              console.log(response);
              if(response.data.status){
                console.log(response.data);
                this.seguindo = response.data.amigos;
                this.seguidores = response.data.seguidores;
              }else{
                alert(response.data.erros);
              }
            })
            .catch((e) => {
              alert("Servido indisponível no momento, tente novamente mais tarde!");
              console.log("Erro na Comunicação com a API!");
            });


          }
        })
        .catch((e) => {
          alert("Servido indisponível no momento, tente novamente mais tarde!");
          console.log("Erro na Comunicação com a API!");
        });


      }
    },
  },
  computed:{
    listaUsuarios(){
      return this.$store.getters.getUsuariosCadastrados;
    }
  }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
