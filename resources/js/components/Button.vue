<template >
  <button :class="['btn btn-rounded text-white btn-padding', bgColor]">
    <slot />
  </button>
</template>
<script>
export default {
  props: {
    bgColor: {
      type: String,
      default: "bg-green",
    },
  },
  methods: {},
};
</script>
<style>
.btn-padding {
  padding: 8px 80px;
}
</style>