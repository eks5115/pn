<template>
  <div id="app">
    <div id="main" tabindex="0" v-if="authenticated">

    </div>

    <div class="login-wrapper" v-else>
      <login-form></login-form>
    </div>

  </div>
</template>

<script>
  import loginForm from './components/auth/login-form.vue';
  import { ls } from './services';

  export default {
    components: {
      loginForm,
    },

    data () {
      return {
        authenticated: false
      }
    },

    mounted () {
      // The app has just been initialized, check if we can get the user data with an already existing token
      const token = ls.get('jwt-token');
      if (token) {
        this.authenticated = true;
      }
    },

    methods: {

    }
  }
</script>

<style lang="scss">

</style>