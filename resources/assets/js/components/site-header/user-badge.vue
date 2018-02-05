<template>
  <div id="userBadge" class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <img v-bind:src="user.avatar" />  <span class="caret"></span>
        </a>

        <ul class="dropdown-menu">
          <li>
            <a href="#">
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              My profile
            </a>
          </li>

          <li >
            <a href="#">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              Setting
            </a>
          </li>

          <li role="separator" class="divider"></li>

          <li >
            <a href="#">
              <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
              Sign out
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    props: [ 'user' ],
    data () {
      return {
      }
    }

  }
</script>

<style lang="scss" scoped>

  a span.item {
    margin-right: 10px;
  }

</style>