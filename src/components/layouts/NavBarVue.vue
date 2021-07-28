<template>
    <nav :class="color || 'grey darken-3'" role="navigation">
        <div class="nav-wrapper">
          <router-link id="logo-container"  :to="url || '/'" class="brand-logo left">
            <img class="logo-navbar" width="120px" height="auto" src='@/assets/images/logo/logo.png' />
          </router-link>
          <ul class="right hide-on-med-and-down">
            <slot/>
          </ul>

          <ul id="nav-mobile" class="sidenav">
            <slot/>
          </ul>
          <a href="#" data-target="nav-mobile" class="sidenav-trigger right">
            <i class="material-icons">menu</i>
          </a>
        </div>
    </nav>


</template>

<script>
export default {
  props: {
  },
  name: 'NavBarVue',
  props:['logo','url','color'],
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.logo-navbar{
  padding: 5px;
  margin-left: 15px;
}
</style>
