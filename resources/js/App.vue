<template>
  <div class="app">
    <notifications position="center" group="error" />
     <NavBar  v-if="this.$route.name != 'login' && this.$route.name != 'register' && this.$route.name !='steps'"></NavBar>
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
  mounted() {
    
  },
  methods: {
    
  },
};
</script>
<style scoped>
</style>