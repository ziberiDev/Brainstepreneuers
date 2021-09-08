<template>
  <div class="row mx-5 g-3 row-cols-2">
    <div class="col text-center">
      <div
        class="
          btn
          d-flex
          justify-content-center
          align-items-center
          accademy-btn
          text-light
          bg-green
        "
        @click="
          selectAccademy($event);
          getAllProjects();
        "
      >
        All
      </div>
    </div>
    <div
      class="col"
      v-for="(accademy, index) in accademies"
      :key="index + 'accademy'"
    >
      <AccademyButton
        @click.native="
          selectAccademy($event);
          getFilteredProjects(accademy.id);
        "
        :accademy="accademy"
      ></AccademyButton>
    </div>
  </div>
</template>
<script>
import AccademyButton from "./AccademyButton.vue";
export default {
  props: ["accademies"],
  data() {
    return {};
  },
  components: {
    AccademyButton,
  },
  methods: {
    getAllProjects() {
      this.$store.dispatch("getAllProjects");
    },
    getFilteredProjects(accademyId) {
      this.$store.dispatch("getProjectsByAccademy", accademyId);
    },
    selectAccademy(event) {
      let container = document.getElementById('projects-container');
      container.scroll({top:0 , behavior: 'smooth'});
      let accademy_btn = document.querySelectorAll(".accademy-btn");
      accademy_btn.forEach((element) => {
        element.classList.add("bg-light");
        element.classList.remove("bg-green");
        element.classList.remove("text-light");
      });
      event.target.classList.toggle("bg-light");
      event.target.classList.toggle("bg-green");
      event.target.classList.toggle("text-light");
    },
  },
};
</script>
<style scoped>
.accademy-btn {
  width: 75%;
  padding: 20px 0;
  margin: 0 auto;
}
</style>