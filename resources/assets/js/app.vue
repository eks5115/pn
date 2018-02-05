<template>
  <div id="app">

    <div id="main" tabindex="0" v-if="authenticated">
      <site-header :user="user"></site-header>
    </div>

    <div class="login-wrapper" v-else>
      <login-form></login-form>
    </div>

  </div>
</template>

<script>
  import queryString from 'query-string';
  import siteHeader from './components/site-header/index.vue';
  import loginForm from './components/auth/login-form.vue';
  import { ls, http } from './services';

  export default {
    components: {
      siteHeader,
      loginForm,
    },

    data () {
      return {
        user: {},
        authenticated: false,
      }
    },

    mounted () {
      // The app has just been initialized, check if we can get the user data with an already existing token
      let token = queryString.parse(location.search).token;

      token ? ls.set('jwt-token', token) : token = ls.get('jwt-token');

      if (token) {
        this.authenticated = true;
        this.init();
      }
    },

    methods: {
      init: function () {
        this.getUser();
      },

      getUser: function () {
        http.get('/user', response => this.user = response.data.data, error => console.log(error));
      }

    }
  }
</script>

<style lang="scss">
  body {
    background-color: #ffffff;
  }
</style>