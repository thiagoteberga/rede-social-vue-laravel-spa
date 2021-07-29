<template>

      <div class="row">
        <grid-vue size="s12 m12 l12" class="input-field">
          <textarea v-model="conteudo.titulo" id="Titulo" class="materialize-textarea"></textarea>
          <label for="Titulo">{{placeholder || "Título"}}</label>
        </grid-vue>
        <grid-vue v-if="conteudo.titulo" size="s12 m12 l12" class="input-field">
          <textarea v-model="conteudo.texto" id="Conteudo" class="materialize-textarea"></textarea>
          <label for="Conteudo">{{placeholder || "Texto"}}</label>
        </grid-vue>
        <grid-vue v-if="conteudo.titulo" size="s12 m12 l12" class="input-field">
          <textarea v-model="conteudo.link" id="Link (Opcional)" class="materialize-textarea"></textarea>
          <label for="Link">{{placeholder || "Link"}}</label>
        </grid-vue>
        <grid-vue v-if="conteudo.titulo" size="s12 m12 l12" class="input-field">
          <textarea v-model="conteudo.imagem" id="Imagem" class="materialize-textarea"></textarea>
          <label for="Imagem">{{placeholder || "Imagem (Opcional)"}}</label>
        </grid-vue>
         <p class="right-align">
         <button v-on:click="addConteudo()" v-if="conteudo.titulo && conteudo.texto" class="btn waves-effect waves-light">
             {{botao || "Publicar"}}
         </button>
         </p>
      </div>
</template>

<script>
import GridVue from '@/components/layouts/GridVue'
export default {
  watch: {
  },
  name: 'PublicarConteudoVue',
  components: {
    GridVue
  },  
  props:['placeholder','botao'],
  data () {
    return {
      conteudo:{titulo:'',
                texto:'',
                link:'',
                imagem:''}
    }
  },
  methods:{
    addConteudo(){
      console.log(this.conteudo);
      this.$http.post(this.$urlAPI+'conteudo/adicionar',{
        titulo: this.conteudo.titulo,
        texto: this.conteudo.texto,
        link: this.conteudo.link,
        imagem: this.conteudo.imagem
      },
      {"headers":{"authorization":"Bearer "+this.$store.getters.getToken}}).then(response => {
        if(response.data.status){
          console.log(response.data.conteudos);
          this.conteudo = {titulo:'',
                texto:'',
                link:'',
                imagem:''};
          this.$store.commit('setConteudosLinhaTempo',response.data.conteudos.data);

        } else if (response.data.status == false && response.data.validacao == true){
            //Erros de Validacao
            console.log("Erro de Validacao");
            let erros = "";
            for (let erro of Object.values(response.data.erros)) {
              erros += erro + " ";
            }
            alert(erros);
          

        }
      })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
