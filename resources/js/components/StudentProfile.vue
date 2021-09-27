<template>
  <div class="row p-5">
    <div class="col-4">
      <div class="row h-100">
        <div class="col-6">
          <div>
            <img class="student-img" :src="student.image" alt="" />
          </div>
        </div>
        <div class="col-6">
          <div>
            <p class="fs-5 fw-bold m-0 text-muted">Name:</p>
            <p class="fs-4 fw-bold">
              {{ student.first_name }} {{ student.last_name }}
            </p>
          </div>
          <div>
            <p class="fs-5 fw-bold m-0 text-muted">Contact:</p>
            <p class="fw-bold">{{ student.email }}</p>
          </div>
        </div>
        <div class="col-3 align-self-end">
          <Button @click.native="$emit('closeStudentView')">Back</Button>
        </div>
      </div>
    </div>
    <div class="col-8">
      <div class="row align-items-center">
        <div class="col-12">
          <p class="text-muted text-start fs-3 fw-bold">Biography</p>
          <p class="text-muted text-start">{{ student.biography }}</p>
        </div>
        <div class="col-12 mt-4">
          <p class="text-muted fs-3 fw-bold text-start">Skills:</p>
          <div class="row row-cols-5 gy-4">
            <Skill
              v-for="(skill, index) in student.skills"
              :key="'skill' + index"
              :accademy="skill"
              :padding="'45px 0'"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Skill from "../components/ComputedButton.vue";
import Button from "../components/Button.vue";
export default {
  props: ["student"],
  data() {
    return {};
  },
  components: {
    Skill,
    Button,
  },
  
  methods: {
    
  }
};
</script>
<style scoped>
.student-img {
  width: 100%;
  border-radius: 50%;
  border: 15px solid white;
}
</style>