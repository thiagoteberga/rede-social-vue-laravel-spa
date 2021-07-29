<template>
      <div class="row">
        <div class="card">
          <div class="card-content">
                <div class="row valign-wrapper">
                  <grid-vue size="s2 m2 l1">
                    <img :src="perfil" :alt="nome" class="circle responsive-img"> <!-- notice the "circle" class -->
                  </grid-vue>
                  <grid-vue size="s10 m10 l11">
                    <span class="black-text">
                      <strong>{{nome || "Nome"}}</strong> - <small>{{data || "20/07/2021 - 22:47"}}</small>
                    </span>
                  </grid-vue>
                </div>

                <slot>
                </slot>

          </div>
          <div class="card-action">
            <p>
                <a @click="curtida(id)">
                    <i class="small material-icons small">{{curtiu}}</i>{{this.totalCurtidas}}
                </a>
                <i class="small material-icons small">insert_comment</i>
            </p>
          </div>
        </div>
      </div>
</template>

<script>
import GridVue from '@/components/layouts/GridVue'
export default {
  name: 'CardConteudoVue',
  components: {
    GridVue
  },
  methods:{
    curtida(id){

      this.$http.put(this.$urlAPI+`conteudo/curtir/`+id, 
                     {},
                     {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
      .then(response => {
          console.log("Retorno Recebido da API!");
          console.log(response);

          if(response.status){
              console.log('Retorno Curtidas com Sucesso');
              this.totalCurtidas = response.data.curtidas;
              this.$store.commit('setConteudosLinhaTempo',response.data.lista.conteudos.data);
              //alert(id);
              if(this.curtiu == 'favorite_border'){
                this.curtiu = 'favorite'
              } else {
                this.curtiu = 'favorite_border'
              }

          }else if(response.data.status == false && response.data.validacao == true){
              console.log('Erro de Validacao');
              alert(response.data.erros);
          }else{
              console.log('Erro no Servidor');
              alert('Problemas ao Gravar!');
          }
      })
      .catch(e => {
        alert("Servidor indisponível no momento, tente novamente mais tarde!")
        console.log("Erro na Comunicação com a API!");
      })

    }
  },
  props:['id','perfil','nome','data','totalcurtidas','curtiuconteudo'],
  data () {
    return {
      curtiu: this.curtiuconteudo ? 'favorite' : 'favorite_border',
      totalCurtidas: this.totalcurtidas,
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
a{
  cursor: pointer;
}
</style>
