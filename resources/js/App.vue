<template>
  <div class="app vh-100 bg-main">
    <notifications position="center" group="error" />
    <NavBar
      v-if="
        this.$route.name != 'login' &&
        this.$route.name != 'register' &&
        this.$route.name != 'step_1' &&
        this.$route.name != 'step_2' &&
        this.$route.name != 'step_3' &&
        this.$route.name != '404'
      "
    ></NavBar>

    <keep-alive>
      <router-view></router-view>
    </keep-alive>
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
    return {};
  },
  mounted() {},
  computed: {},
  methods: {},
};
</script>
<style scoped>
</style>