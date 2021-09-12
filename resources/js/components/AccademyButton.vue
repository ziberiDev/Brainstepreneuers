<template>
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
      :style="styles"
    >
      {{ this.accademy.name }}
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {};
  },
  props: {
    accademy: { type: Object },
    padding: {
      type: String,
      default: "20px 0",
    },
  },
  computed: {
    styles() {
      return {
        padding: this.padding,
      };
    },
  },
  methods: {},
};
</script>
<style scoped>
.accademy-btn {
  max-height: 65px;
  width: 75%;
  /* padding: 20px 0; */
  margin: 0 auto;
}
</style>