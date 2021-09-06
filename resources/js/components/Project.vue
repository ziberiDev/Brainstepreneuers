<template>
  <div class="col project-container">
    <div class="row">
      <div class="col-4">
        <div class="text-center">
          <img class="owner-img" :src="project.owner.image" alt="" />
          <p class="text-center">
            {{ project.owner.first_name }} {{ project.owner.last_name }}
          </p>
          <p>{{ project.owner.accademy.name }}</p>
        </div>
        <div class="d-flex align-items-end justify-content-center">
          <div v-for="(accademy, index) in project.accademies" :key="index">
            <p
              class="accademy-text  m-0 text-center circle bg-green"
              v-text="excerpt(accademy.name)"
            ></p>
          </div>
        </div>
      </div>
      <div class="col-8"></div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    project: { type: Object },
  },
  methods: {
    excerpt(accademyName) {
      switch (accademyName) {
        case "Backend Development":
          return "Backend  Dev";

        case "Frontend Development":
          return "Frontend Dev";

        default:
          return accademyName;
      }
    },
  },
};
</script>
<style scoped>
.owner-img {
  margin-top: -55px;
  width: 100px;
  height: 100px;
  border-radius: 50%;
}
.project-container {
  width: 90%;
  background-color: white;
}
.accademy-text {
  font-size: 11px;
}
.circle {
 width: 65px;
 height: 35px;
  padding: 5px 10px 10px 10px;
  color: white;
  border-top-left-radius: 100px; /* 100px of height + 10px of border */
  border-top-right-radius: 100px; /* 100px of height + 10px of border */
  border-bottom: 0;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
</style>