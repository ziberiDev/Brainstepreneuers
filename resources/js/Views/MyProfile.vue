<template>
  <div>
    <MyProjects v-if="this.page == 'projects'" :myProjects="myProjects" />
  </div>
</template>
<script>
import MyProjects from "./MyProjects.vue";
export default {
  watch: {
    "$route.params.page": function (page) {
      this.page = page;
      console.log(this.page);
    },
  },
  data() {
    return {
      page: this.$route.params.page,
    };
  },
  components: {
    MyProjects,
  },
  computed: {
    me() {
      return this.$store.state.me;
    },
    myProjects() {
      return this.$store.state.me.projects
    }
  },
  mounted() {
    this.$store.dispatch("getMyProjects");
  },
  methods: {},
};
</script>
<style scoped>
</style>