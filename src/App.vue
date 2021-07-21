<template>
  <span>
    <header>
      <nav-bar-vue color="amber darken-1" url="http:\\google.com.br" logo="Maroto"/>
    </header>

    <main>
      <div class="container">

        <div class="row">
          <grid-vue size="4">Menu</grid-vue>
          <grid-vue size="8">
            <router-view/>
          </grid-vue>
        </div>

        
      </div>
    </main>
    
     <footer-vue color="amber darken-1" logo="Logo" title = 'Titulo' copyright = 'Reservado por Parametro' author = 'Thiago Teberga' description = 'Footer personalizado'>
                  <li><a class="grey-text text-lighten-3" href="#!">Link Slot 1</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link Slot 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
     </footer-vue>

  </span>
</template>

<script>
import NavBarVue from '@/components/layouts/NavBarVue'
import FooterVue from '@/components/layouts/FooterVue'
import GridVue from '@/components/layouts/GridVue'
export default {
  name: 'App',
  components: {
    NavBarVue,
    FooterVue,
    GridVue
  }
}
</script>

<style>
</style>