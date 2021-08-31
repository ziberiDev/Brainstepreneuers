<template>
  <div class="app">
    <notifications position="center" group="error" />
    <NavBar
      v-if="
        this.$route.name != 'login' &&
        this.$route.name != 'register' &&
        this.$route.name != 'step_1' &&
        this.$route.name != 'step_2' &&
        this.$route.name != 'step_3'
      "
    ></NavBar>

    <router-view> </router-view>
  </div>
</template>
<script>
import NavBar from "./components/NavBar.vue";
import router from "./Router/router.js";
export default {
  name: "app",
  components: {
    NavBar,
  },
  data() {
    return {
      //
    };
  },
  mounted() {
    console.log(location);
  },
  computed: {
    currentRoute() {
      //  return router.history.getCurrentLocation()
      return this.$router.history.getCurrentLocation();
    },
  },
  methods: {},
};
</script>
<style scoped>
</style>