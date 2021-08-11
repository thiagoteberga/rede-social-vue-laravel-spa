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
                        <strong>{{nome || "Nome"}}</strong> - <small>{{data || "20/07/2021 - 22:47"}}</small>
                      </router-link>
                    </span>
                  </grid-vue>
                </div>

                <slot>
                </slot>

          </div>
          <div class="card-action">
            <p>
                <a @click="curtida(id)">
                    <i class="material-icons small">{{curtiu}}</i>{{this.totalCurtidas}}
                </a>
                <a @click="abreComentarios()">
                    <i class="material-icons small">insert_comment</i>{{listaComentarios.length}}
                </a>
            </p>
            <p v-if="exibirComentario" class="right-align">
                <input v-model="textoComentario" type="text" placeholder="Comentar">
                <button @click="comentar(id)" v-if="textoComentario" class="btn waves-effect waves-light orange"><i class="material-icons small">send</i></button>
            </p>
            <p v-if="exibirComentario">
              <ul class="collection">
                <li class="collection-item avatar" v-for="item in comentarios" :key="item.id">
                  <img :src="item.user.imagem" alt="" class="circle">
                  <span class="title"> {{item.user.name}} - ID: {{item.user_id}} <small> - {{item.data}}</small></span>
                  <p>
                    {{item.texto}}
                  </p>
                </li>
              </ul>
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
      if(!this.textoComentario){
        return;
      }
      this.$http.put(this.$urlAPI+`conteudo/comentar/`+id, 
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
  },
  props:['id','userid','perfil','nome','data','totalcurtidas','curtiuconteudo','comentarios'],
  data () {
    return {
      curtiu: this.curtiuconteudo ? 'favorite' : 'favorite_border',
      totalCurtidas: this.totalcurtidas,
      exibirComentario: false,
      textoComentario: '',
      listaComentarios: this.comentarios || []
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
