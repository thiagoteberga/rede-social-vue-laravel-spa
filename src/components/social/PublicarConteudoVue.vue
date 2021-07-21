<template>
      <div class="row">
        <grid-vue size="12" class="input-field">
          <textarea v-model="conteudo" id="Conteudo" class="materialize-textarea"></textarea>
          <label for="Conteudo">{{placeholder || "O que está acontecendo?"}}</label>
        </grid-vue>
        <p>
          <grid-vue v-if="conteudo" class="btn waves-effect waves-light" size="2 offset-s10">{{botao || "Publicar"}}</grid-vue>
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
      conteudo:''
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
