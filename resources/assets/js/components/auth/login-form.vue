<template>
  <div>
    <form v-on:submit.prevent="login">
      <div class="form-group">
        <input v-model="email" class="form-control" type="email" placeholder="Email Address"/>
        <input v-model="password" class="form-control" type="password" placeholder="Password"/>
      </div>
      <button class="btn btn-default" type="submit">LogIn</button>
    </form>
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
  form {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 280px;
    padding: 1.8rem;
    background: rgba(255,255,255,.08);
    border-radius: .6rem;
    border: 1px solid #333;

    &::before {
       content: " ";
       display: block;
       background: url(../../../img/logo.svg) center top no-repeat;
       background-size: 156px;
       height: 172px;
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