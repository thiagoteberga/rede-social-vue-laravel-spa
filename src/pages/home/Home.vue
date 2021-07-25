<template>
  <site-template>

    <span slot="menuesquerdo">
      <div class="row valign-wrapper">
        <grid-vue size="4">
          <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
        </grid-vue>
        <grid-vue size="8">
          <span class="black-text">
            <h5>Marina Silva</h5>
            This is a square image. Add the "circle" class to it to make it appear circular.
          </span>
        </grid-vue>
      </div>
    </span>

    <span slot="principal">
      <publicar-conteudo-vue/>
      <card-conteudo-vue 
        perfil="https://materializecss.com/images/yuna.jpg"
        nome="Marina Teberga"
        data="20/07/2021 22:56">

          <card-detalhe-vue 
            img="https://materializecss.com/images/sample-1.jpg"
            txt="Não obstante, a constante divulgação das informações nos obriga à análise dos métodos utilizados na avaliação de resultados."
            titulo="Titulo do Card">
          </card-detalhe-vue>
      </card-conteudo-vue>
    </span>
  </site-template>
</template>

<script>
import CardConteudoVue from '@/components/social/CardConteudoVue'
import CardDetalheVue from '@/components/social/CardDetalheVue'
import PublicarConteudoVue from '@/components/social/PublicarConteudoVue'
import SiteTemplate from '@/templates/SiteTemplate'
export default {
  name: 'Home',
  components: {
    CardConteudoVue,
    CardDetalheVue,
    PublicarConteudoVue,
    SiteTemplate
  },
  data () {
    return {
    }
  }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
