<template>
      <div class="row">
        <div class="card">
          <div class="card-content">
                <div class="row valign-wrapper">
                  <grid-vue size="s2 m2 l1">
                    <router-link :to="'/pagina/'+userid+'/'+$slug(nome,{lower: true})">
                      <img :src="perfil" :alt="nome" class="circle responsive-img"> <!-- notice the "circle" class -->
                    </router-link>
                  </grid-vue>
                  <grid-vue size="s10 m10 l11">
                    <span class="black-text">
                      <router-link :to="'/pagina/'+userid+'/'+$slug(nome,{lower: true})">
                        <strong>{{nome || "Nome"}}</strong> - <small>{{email}}</small>
                      </router-link>
                    </span>
                  </grid-vue>
                </div>
          </div>
        </div>
      </div>
</template>

<script>
import GridVue from '@/components/layouts/GridVue'
export default {
  name: 'CardUsuarioVue',
  components: {
    GridVue
  },
  props:['id','userid','perfil','nome','email'],
  data () {
    return {
      curtiu: this.curtiuconteudo ? 'favorite' : 'favorite_border',
      totalCurtidas: this.totalcurtidas,
      exibirComentario: false,
      textoComentario: '',
      listaComentarios: this.comentarios || []
    }
  },

  methods:{
    curtida(id){
      
      let url = '';

      if(this.$route.name =="Home"){
        url = 'conteudo/curtir/'
      }else{
        url = 'conteudo/pagina/curtir/'
      }

      this.$http.put(this.$urlAPI+url+id, 
                     {},
                     {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
      .then(response => {
          console.log("Retorno Recebido da API!");
          console.log(response);

          if(response.data.status){
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

    },
    comentar(id){

      let url = '';

      if(this.$route.name =="Home"){
        url = 'conteudo/comentar/'
      }else{
        url = 'conteudo/pagina/comentar/'
      }

      if(!this.textoComentario){
        return;
      }
      this.$http.put(this.$urlAPI+url+id, 
                     {texto:this.textoComentario},
                     {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}})
      .then(response => {
          console.log("Retorno Recebido da API!");
          console.log(response);

          if(response.data.status){
              console.log('Retorno Comentario com Sucesso');
              this.textoComentario = '';
              this.$store.commit('setConteudosLinhaTempo',response.data.lista.conteudos.data);
              //alert(id);
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

    },
    abreComentarios(){
      this.exibirComentario = !this.exibirComentario; //Ao clicar ele alterar para TRUE ou FALSE
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
