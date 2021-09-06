<template>
  <div class="container-fluid vh-100 bg-main">
    <div class="row position-fixed start-0 end-0">
      <div class="col-10 mx-auto my-5">
        <div class="fs-1 fw-bold">
          <span>Accademies</span>
          <div class="line orange-bg"></div>
        </div>
      </div>
    </div>

    <div
      class="
        row
        accademies-container
        vh-100
        justify-content-between
        align-items-center
      "
    >
      <div class="col" v-for="accademy in accademies" v-bind:key="accademy">
        <div
          @click="setAccademy(accademy.id, $event)"
          class="
            bg-light
            d-flex
            justify-content-center
            align-items-center
            accademy-btn
            btn
          "
        >
          {{ accademy.name }}
        </div>
      </div>
      <div class="col-12">
        <Button @click.native="updateAccademy()" class="float-end">Next</Button>
      </div>
    </div>
  </div>
</template>
<script>
import Button from "../components/Button.vue";

export default {
  data() {
    return {
      selected_accademy: null,
    };
  },
  components: {
    Button,
  },
  computed: {
    accademies() {
      return this.$store.state.accademies;
    },
  },
  mounted() {
    this.$store.dispatch("getAccademies");
    this.$store.dispatch("getMe");
  },
  methods: {
    setAccademy(accademyID, event) {
      let accademy_btn = document.querySelectorAll(".accademy-btn");
      accademy_btn.forEach((element) => {
        element.classList.add("bg-light");
        element.classList.remove("bg-green");
        element.classList.remove("text-light");
      });
      event.target.classList.toggle("bg-light");
      event.target.classList.toggle("bg-green");
      event.target.classList.toggle("text-light");
      this.selected_accademy = accademyID;
    },
    updateAccademy() {
      if (this.selected_accademy) {
        axios
          .post(location.origin + "/api/step-1", {
            accademy_id: this.selected_accademy,
          })
          .then(() => {
            this.$router.replace("step_2");
          })
          .catch((err) => err);
      } else {
        this.$notify({
          group: "error",
          type: "error",
          title: "Please select an accademy",
        });
      }
    },
  },
};
</script>
<style scoped>
.accademies-container {
  margin: 0 100px;
}
.accademy-btn {
  padding: 0 50px;
  height: 80px;
}
</style>