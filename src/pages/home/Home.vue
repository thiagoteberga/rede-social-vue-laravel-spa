<template>
  <site-template>

    <span slot="menuesquerdo">
      <div class="row valign-wrapper">
        <grid-vue size="4">
          <img :src="this.usuarioLogado.imagem" alt="this.usuarioLogado.name" class="circle responsive-img"> <!-- notice the "circle" class -->
        </grid-vue>
        <grid-vue size="8">
          <span class="black-text">
            <h5>{{this.usuarioLogado.name}}</h5>
            This is a square image. Add the "circle" class to it to make it appear circular.
          </span>
        </grid-vue>
      </div>
    </span>

    <span slot="principal">
      <publicar-conteudo-vue />

      <card-conteudo-vue v-for="item in listaConteudos" :key="item.id"
        :id="item.id"
        :totalcurtidas="item.total_curtidas"
        :comentarios="item.comentarios"
        :curtiuconteudo="item.curtiu_conteudo"
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
  name: 'Home',
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
      pararScroll: false
    }
  },
  methods: {
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
        if(response.data.status){
          this.$store.commit('setPaginacaoConteudosLinhaTempo',response.data.conteudos.data);
          this.urlProximaPagina = response.data.conteudos.next_page_url;
          this.pararScroll = false;
        }

      })
      .catch((e) => {
        alert("Servido indisponível no momento, tente novamente mais tarde!");
        console.log("Erro na Comunicação com a API!");
      });
    }
  },
  computed:{
    listaConteudos(){
      return this.$store.getters.getConteudosLinhaTempo;
    }
  },
  created(){
    //console.log('Created.')
    let usuarioSession = this.$store.getters.getUsuario;
    if(usuarioSession){
      this.usuarioLogado = this.$store.getters.getUsuario;

      this.$http
      .get(this.$urlAPI+`conteudo/lista`, {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
      .then((response) => {
        console.log("Retorno Recebido da API!");
        console.log(response);
        if(response.data.status){
          this.$store.commit('setConteudosLinhaTempo',response.data.conteudos.data);
          this.urlProximaPagina = response.data.conteudos.next_page_url;
        }

      })
      .catch((e) => {
        alert("Servido indisponível no momento, tente novamente mais tarde!");
        console.log("Erro na Comunicação com a API!");
      });


    }
  },
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
