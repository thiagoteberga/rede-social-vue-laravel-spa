<template>
 
            <router-view/>

</template>

<script>

export default {
  name: 'App',
  components: {
  }
}
</script>

<style>
  .body-span {
    display: flex;
    min-height: 100vh;
    flex-direction: column;
    background-image: url("\assets\images\background\background.jpg");
  }

  main {
    flex: 1 0 auto;
    margin-top: 40px;
  }
</style>