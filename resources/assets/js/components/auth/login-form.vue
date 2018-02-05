<template>
  <div id="login-form" class="container">
    <div class="row">
      <div id="login-form-logo" class="col-md-4 col-md-offset-4">

      </div>
      <div class="col-md-10 col-md-offset-1">
        <hr />
      </div>

    </div>
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <form v-on:submit.prevent="login">
          <div class="form-group">
            <input v-model="email" class="form-control" type="email" placeholder="Email Address"/>
            <input v-model="password" class="form-control" type="password" placeholder="Password"/>
          </div>
          <button class="btn btn-primary" type="submit">LogIn</button>
        </form>
      </div>

      <div class="col-md-4 col-md-offset-4">
        <hr />
      </div>

      <div class="col-md-4 col-md-offset-4">
        <a class=".btn btn-github-login" href="/api/login/github">
          <div></div>
          Log in with github
        </a>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  import { http, ls } from '@/services'

  export default {
    data: function() {
      return {
        email: "",
        password: ""
      }
    },

    methods: {
      login: function () {
        http.post('/auth', {
          email: this.email,
          password: this.password
        }, data => console.log(data), error => console.error(error));
      },
    }
  }
</script>

<style lang="scss" scoped>

  #login-form {
    padding-top:5.00em;
  }

  #login-form-logo {
    content: " ";
    display: block;
    background: url(../../../img/logo.svg) center top no-repeat;
    background-size: 156px;
    height: 172px;
  }

  .btn-github-login {
    font-size: 1.25em;
    font-weight: bold;
    line-height: 1.5em;
    display: block;
    padding: .75em;
    color: #000;
    border: 1px solid #ddd;
    border-bottom-width: 2px;
    border-radius: .5em;
    background-color: #fff;

    text-decoration: none;
    text-align: center;
    div {
      width: 1.5em;
      height: 1.5em;
      margin-right: .5em;
      vertical-align: middle;
      background: url(../../../img/github-octocat.svg) no-repeat;
      background-size: 1.5em 1.5em;
      display: inline-block;
    }
  }

  input {
    display: block;
    margin-top: 12px;
    border: 0;
    background: #fff;
    outline: none;
    width: 100%;
  }

  button {
    display: block;
    margin-top: 12px;
    width: 100%;
  }
</style>