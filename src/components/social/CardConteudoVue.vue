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
                <i class="small material-icons small">favorite_border</i>
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
  props:['perfil','nome','data'],
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
