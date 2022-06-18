<template>
  <div class="container-fluid bg-home position-relative">
    <div class="row">
      <div class="col-4">
        <div class="text-center pt-5">
          <p class="fs-4 fw-bolder">In what field can you be amazing?</p>
        </div>
        <ProjectsFilter class="pt-5" :accademies="accademies"> </ProjectsFilter>
      </div>
      <div class="col-8">
        <div id="projects-container" class="row projects-container row-cols-1">
          <Project
            class="my-5"
            v-for="(project, index) in projects"
            :key="index + 'project'"
            :project="project"
          >
          </Project>
          <Pagination :pagination="pagination"> </Pagination>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Pagination from "../components/Pagination.vue";
import Project from "../components/Project.vue";
import ProjectsFilter from "../components/ProjectsFilter.vue";

export default {
  data() {
    return {};
  },
  components: {
    Project,
    ProjectsFilter,
    Pagination,
  },
  computed: {
    accademies() {
      return this.$store.state.accademies;
    },
    projects() {
      return this.$store.state.projects;
    },
    pagination() {
      return this.$store.state.pagination;
    },
  },
  mounted() {
    this.$store.dispatch("getAccademies");
    this.$store.dispatch("getAllProjects");
  },
  methods: {},
};
</script>
<style lang="scss" scoped>
.bg-home {
  height: 87.5vh;
  background-image: url("../assets/bg-images/3.jpg");
  background-repeat: no-repeat;
  background-size: 100% 100%;
  background-position: center;
}
.projects-container {
  padding: 50px 0;
  overflow-y: scroll;
  height: 80vh;
  &::-webkit-scrollbar {
    display: none;
  }
}
</style>