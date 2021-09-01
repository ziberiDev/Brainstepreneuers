<template>
  <div class="col project-container">
    <div class="row">
      <div class="col-4">
        <div class="text-center">
          <img class="owner-img" :src="project.owner.image" alt="" />
          <p class="text-center">{{project.owner.first_name }} {{project.owner.last_name }}</p>
          <p>{{ project.owner.accademy.name }}</p>
        </div>
        <div class="d-flex justify-content-evenly mx-2">
            <div class="w-25"  v-for="accademy in project.accademies" :key='accademy.id'>
                {{accademy.name}}
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
};
</script>
<style scoped>
.owner-img {
    margin-top: -55px;
  width: 100px;
  height: 100px;
  border-radius: 50%;
}
.project-container{
    width: 90%;
    background-color: white;
}
</style>