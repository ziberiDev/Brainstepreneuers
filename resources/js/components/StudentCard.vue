<template>
  <div class="col">
    <div class="bg-white">
      <div class="text-center">
        <img class="student-img" :src="application.student.image" alt="" />
      </div>
      <div class="text-center">
        <p class="fs-3 fw-bold">
          {{ application.student.first_name }}
          {{ application.student.last_name }}
        </p>
        <p
          class="text-orange fw-bolder"
          v-text="this.$positionExcerpt(application.student.accademy.name)"
        ></p>
        <div>
          <p>{{ application.message }}</p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["application"],
  data() {
    return {};
  },
  mounted() {},
  methods: {},
};
</script>
<style scoped>
.student-img {
  margin-top: -55px;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: 8px solid white;
}
</style>