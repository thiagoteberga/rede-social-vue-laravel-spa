<template>
     <footer :class="'page-footer ' + color">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">{{title}}</h5>
                <p class="grey-text text-lighten-4">{{description || "Descricao"}}</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">{{logo || "Logo"}}</h5>
                <ul>
                    <slot></slot>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            {{copyright || "Todos os direitos reservados."}}
            <a class="grey-text text-lighten-4 right" href="#!">{{author || "Developed by Thiago Teberga"}}</a>
            </div>
          </div>
    </footer>
</template>

<script>
export default {
  name: 'FooterVue',
  props:['color','title','copyright', 'author','logo','description'],
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
