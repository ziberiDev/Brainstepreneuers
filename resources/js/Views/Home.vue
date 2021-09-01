<template>
  <div class="container-fluid bg-home">
    <div class="row">
      <div class="col-4">
        <div class="row mx-5 g-3 row-cols-2">
          <div class="col text-center">
            <div
              class="
                btn
                d-flex
                justify-content-center
                align-items-center
                accademy-btn
                bg-light
              "
            >
              All
            </div>
          </div>
          <Accademy
            v-for="accademy in accademies"
            v-bind:key="accademy.id"
            :accademy="accademy"
          >
          </Accademy>
        </div>
      </div>
      <div class="col-8">
        <div class="row projects-container row-cols-1">
          <Project
            class="my-5"
            v-for="project in projects"
            :key="project.id"
            :project="project"
          >
          </Project>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Accademy from "../components/Accademy.vue";
import Project from "../components/Project.vue";
export default {
  data() {
    return {};
  },
  components: {
    Accademy,
    Project,
  },
  computed: {
    accademies() {
      return this.$store.state.accademies;
    },
    projects() {
      return this.$store.state.projects;
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
.accademy-btn {
  width: 75%;
  padding: 20px 0;
  margin: 0 auto;
}
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
  height: 600px;
  &::-webkit-scrollbar {
    display: none;
  }
}
</style>