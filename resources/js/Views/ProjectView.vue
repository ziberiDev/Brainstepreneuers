<template>
  <div
    class="row p-2 position-relative h-100 bg-main"
    :class="student ? 'dim' : ''"
  >
    <div class="col-12 bg-main studentModal" v-if="student">
      <StudentProfile @closeStudentView="closeStudentView" :student="student" />
    </div>

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
        <Button
          @click.native="assembleProject(project.id)"
          class="px-2"
          :bgColor="'orange-bg'"
          >Team Assembled <i class="fas fa-check"></i
        ></Button>
      </div>
    </div>
    <div class="col-10 mx-auto">
      <div class="row row-cols-3 g-5">
        <p v-if="!project.applications.length" class="fs-1">
          No Applicants jet!!
        </p>
        <StudentCard
          @setStudent="showModal($event)"
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
import StudentProfile from "../components/StudentProfile.vue";
export default {
  props: ["project"],
  data() {
    return {
      student: false,
    };
  },
  components: {
    Button,
    StudentCard,
    StudentProfile,
  },
  methods: {
    unsetProjectProfile() {
      this.$store.state.projectProfile = null;
    },
    assembleProject(projectID) {
      this.$store.dispatch("assembleProject", projectID).then((message) => {
        this.$notify({
          group: "error",
          title: message,
        });
      });
    },
    showModal: function (_student) {
      this.student = _student;
    },
    closeStudentView: function () {
      this.student = false;
    },
  },
  beforeDestroy() {
    this.$store.dispatch("setProjectProfile", null);
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
.studentModal {
  text-align: center;
  width: 100%;
  height: 100%;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  z-index: 9999;
  opacity: 1;
}
</style>