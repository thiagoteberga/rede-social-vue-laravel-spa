<template>
    <nav :class="color || 'grey darken-3'">
        <div class="nav-wrapper container">
        <router-link :to="url || '/'" class="brand-logo right"> {{logo || 'Belvedere'}}</router-link>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
          <slot/>
        </ul>
        </div>
    </nav>
</template>

<script>
export default {
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
</style>
