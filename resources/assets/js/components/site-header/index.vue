<template>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">
          <img src="../../../img/logo.svg">
        </a>
      </div>
      <user-badge :user="user"></user-badge>
    </div>
  </nav>
</template>

<script>

  import userBadge from './user-badge.vue';

  export default {

    components: { userBadge },
    props: [ 'user' ]

  }
</script>

<style lang="scss" scoped>
  nav img {
    height: 30px;
  }
</style>