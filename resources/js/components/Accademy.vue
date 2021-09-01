<template>
  <div class="wrapper">
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
        {{ this.accademy.name }}
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    accademy: { type: Object },
  },
};
</script>
<style scoped>
.accademy-btn {
  max-height: 65px;
  width: 75%;
  padding: 20px 0;
  margin: 0 auto;
}
</style>