<template>
  <span>
    <login-template>
      
      <h2>Login</h2>
      <input type="text" placeholder="Email" value="">
      <input type="password" placeholder="*******" value="">
      <button type="button" class="btn">Entrar</button>
    </login-template>
  </span>
</template>

<script>
import CardConteudoVue from '@/components/social/CardConteudoVue'
import LoginTemplate from '@/templates/LoginTemplate'
export default {
  name: 'Login',
  components: {
    CardConteudoVue,
    LoginTemplate
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
