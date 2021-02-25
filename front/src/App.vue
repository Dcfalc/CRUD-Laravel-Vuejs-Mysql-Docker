<template>
  <div id="app">

    <Menu />

    <router-view></router-view>

  </div>
</template>

<script>
import Menu from './components/shared/Menu';

export default {
  name: 'App',
  components: {
    Menu,
  }
}
</script>
