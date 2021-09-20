<template>
  <div class="row p-2 h-100 bg-main">
    <div class="col-12 d-flex justify-content-between">
      <div>
        <p class="fs-3 fw-bold">{{ project.name }} - Applicants</p>
        <p class="fs-5 fw-bold">
          Choose your teammeates
          <img class="arrow-right" src="/images/arrow-right.png" alt="" />
        </p>
      </div>
      <div class="text-center">
        <small class="d-block text-muted">Ready to start?</small>
        <small class="d-block text-muted">Click on the button below.</small>
        <Button class="px-2" :bgColor="'orange-bg'"
          >Team Assembled <i class="fas fa-check"></i
        ></Button>
      </div>
    </div>
    <div class="col-10 mx-auto">
      <div class="row row-cols-3 g-5">
        <StudentCard
          v-for="(application, index) in project.applications"
          :key="index"
          :application="application"
        ></StudentCard>
      </div>
    </div>
    <div>
      <Button @click.native="unsetProjectProfile()" class="float-end"
        >Back</Button
      >
    </div>
  </div>
</template>
<script>
import Button from "../components/Button.vue";
import StudentCard from "../components/StudentCard.vue";
export default {
  props: ["project"],
  data() {
    return {};
  },
  components: {
    Button,
    StudentCard,
  },
  methods: {
    unsetProjectProfile() {
      this.$store.state.projectProfile = null;
    },
  },
};
</script>
<style scoped>
.arrow-right {
  position: absolute;
  margin-left: 25px;
  padding: 15px;
  height: 9%;
}
</style>