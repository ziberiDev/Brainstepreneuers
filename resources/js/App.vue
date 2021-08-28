<template>
  <div class="app">
    <notifications  position="top center" group="error" />

    <!-- <NavBar></NavBar> -->
    <router-view></router-view>
  </div>
</template>
<script>
import NavBar from "./components/NavBar.vue";
export default {
  name: "app",
  components: {
    NavBar,
  },
};
</script>
<style scoped>
.my-warning-notification {
background-color: tomato;

}
</style>