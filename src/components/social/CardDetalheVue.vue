<template>
    <span>
      <div v-if="img" class="card-image"> <!-- v-if faz com que o elementa so seja criado se a condicao for verdadeira -->
        <img :src="img">
        <span class="card-title">{{title}}</span>
      </div>
      <div v-if="txt" class="card-content">
        <p>{{txt}}</p>
      </div>
    </span>
</template>

<script>
export default {
  name: 'CardDetalheVue',
  components: {
  },
  props:['img','title','txt'],
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
