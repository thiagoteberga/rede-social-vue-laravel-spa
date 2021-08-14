<template>
  <site-template :qtseguindo="seguindo.length" :qtseguidores="seguidores.length">

    <span slot="menuesquerdo">
      <div class="row valign-wrapper">
        <grid-vue size="4">
          <router-link :to="'/pagina/'+this.donoPagina.id+'/'+$slug(this.donoPagina.name,{lower: true})">
            <img :src="this.donoPagina.imagem" alt="this.donoPagina.name" class="circle responsive-img"> <!-- notice the "circle" class -->
          </router-link>
          <button v-if="exibeBtnSeguir" @click="amigo(donoPagina.id)" class="btn blue">{{textoBtnSeguir}}</button>
        </grid-vue>
        <grid-vue size="8">
          <span class="black-text">
          <router-link :to="'/pagina/'+this.donoPagina.id+'/'+$slug(this.donoPagina.name,{lower: true})">
            <h5>{{this.donoPagina.name}}</h5>
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
      <publicar-conteudo-vue />

      <card-conteudo-vue v-for="item in listaConteudos" :key="item.id"
        :id="item.id"
        :totalcurtidas="item.total_curtidas"
        :comentarios="item.comentarios"
        :curtiuconteudo="item.curtiu_conteudo"
        :userid="item.user.id"
        :perfil="item.user.imagem"
        :nome="item.user.name"
        :data="item.data">

          <card-detalhe-vue 
            :img="item.imagem"
            :txt="item.titulo"
            :titulo="item.texto"
            :link="item.link">
          </card-detalhe-vue>
      </card-conteudo-vue>
      <p class="center-align" v-if="this.urlProximaPagina">
        <button @click="carregaPaginacao()" type="button" class="btn blue">Carregar Mais...</button>
      </p>
      <div v-scroll="handleScroll"></div>
    </span>
  </site-template>
</template>

<script>
import CardConteudoVue from '@/components/social/CardConteudoVue'
import CardDetalheVue from '@/components/social/CardDetalheVue'
import PublicarConteudoVue from '@/components/social/PublicarConteudoVue'
import GridVue from '@/components/layouts/GridVue'
import SiteTemplate from '@/templates/SiteTemplate'
export default {
  name: 'Pagina',
  components: {
    CardConteudoVue,
    CardDetalheVue,
    PublicarConteudoVue,
    SiteTemplate,
    GridVue
  },  
  data () {
    return {
      usuarioLogado:"",
      urlProximaPagina: null,
      pararScroll: false,
      donoPagina: {iamgem:'', name:''},
      exibeBtnSeguir: false,
      seguindo: [],
      seguidores: [],
      seguindoLogado: [],
      textoBtnSeguir: 'Seguir'
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
        .get(this.$urlAPI+`conteudo/pagina/lista/`+this.$route.params.id, {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
        .then((response) => {
          console.log("Retorno Recebido da API!");
          console.log(response);
          if(response.data.status){
            this.$store.commit('setConteudosLinhaTempo',response.data.conteudos.data);
            this.urlProximaPagina = response.data.conteudos.next_page_url;
            this.donoPagina = response.data.dono;

            if(this.donoPagina.id != this.usuarioLogado.id){
              this.exibeBtnSeguir = true;
            } else {
              this.exibeBtnSeguir = false;
            }

            //Retorna Lista de Seguidores
            this.$http
            .get(this.$urlAPI+`usuario/seguidores/`+this.donoPagina.id, {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
            .then((response) => {
              console.log("Retorno Recebido da API!");
              console.log(response);
              if(response.data.status){
                console.log(response.data);
                this.seguindo = response.data.amigos;
                this.seguindoLogado = response.data.amigoslogado;
                this.eAmigo();
                this.seguidores = response.data.seguidores;
              }else{
                alert(response.data.erros);
              }
            })
            .catch((e) => {
              alert("Lista Seguidores - Servidor indisponível no momento, tente novamente mais tarde!");
              console.log("Erro na Comunicação com a API!");
            });

          }

        })
        .catch((e) => {
          alert("Lista Postagens - Servidor indisponível no momento, tente novamente mais tarde!");
          console.log("Erro na Comunicação com a API!");
        });


      }
    },
    eAmigo(){
      
      for(let amigo of this.seguindoLogado){
        if(amigo.id == this.donoPagina.id){
          this.textoBtnSeguir = 'Deixar de Seguir';
          return;
        }
      }
      this.textoBtnSeguir = 'Seguir';

    },
    handleScroll() {
      //console.log(window.scrollY); //Posicao da tela em que a pessoa esta
      //console.log(document.body.clientHeight); //Tamanho da Pagina

      if(this.pararScroll){
        return;
      }

      if(window.scrollY >= document.body.clientHeight - 1324){
        //console.log('OKKKK');
        this.pararScroll = true;
        this.carregaPaginacao();
      }
    },
    amigo(idamigo) {
      //console.log('Amigo estou aqui! ID: '+id);

      this.$http.post(this.$urlAPI+`usuario/seguir`, 
                     {id:idamigo},
                     {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
      .then(response => {
          console.log("Retorno Recebido da API!");
          console.log(response);

          if(response.data.status){
              //console.log(response.data.status)
              this.seguindoLogado = response.data.amigos;
              this.eAmigo();
              this.seguidores = response.data.seguidores;
          }else{
              alert(response.data.erros);
          }
      })
      .catch(e => {
        alert("Nao foi Possivel Seguir - Servidor indisponível no momento, tente novamente mais tarde!")
        console.log("Erro na Comunicação com a API!");
      })


    },
    carregaPaginacao(){
      //alert('Ok');

      if(!this.urlProximaPagina){
        return;
      }

      this.$http
      .get(this.urlProximaPagina, {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
      .then((response) => {
        console.log("Retorno Recebido da API!");
        console.log(response);
        if(response.data.status && this.$route.name == 'Pagina'){
          this.$store.commit('setPaginacaoConteudosLinhaTempo',response.data.conteudos.data);
          this.urlProximaPagina = response.data.conteudos.next_page_url;
          this.pararScroll = false;
        }

      })
      .catch((e) => {
        alert("Paginacao - Servidor indisponível no momento, tente novamente mais tarde!");
        console.log("Erro na Comunicação com a API!");
      });
    }
  },
  computed:{
    listaConteudos(){
      return this.$store.getters.getConteudosLinhaTempo;
    }
  }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
