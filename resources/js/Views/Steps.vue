<template>
  <div class="container-fluid vh-100 bg-main">
    <div
      class="
        row
        accademies-container
        vh-100
        justify-content-between
        align-items-center
      "
      v-if="steps.step_1"
    >
      <div class="col" v-for="accademy in accademies" v-bind:key="accademy.id">
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

    <div class="row" v-if="steps.step_2"></div>

    <div class="row" v-if="steps.step_3"></div>
  </div>
</template>
<script>
import Button from "../components/Button.vue";

export default {
  data() {
    return {
      steps: {
        step_1: false,
        step_2: false,
        step_3: false,
      },
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
    let step = this.$route.query.step;
    this.setActiveStep(step);
  },
  methods: {
    setActiveStep(step) {
      switch (step) {
        case "1":
          this.steps.step_1 = true;
          break;
        case "2":
          this.steps.step_2 = true;
          break;
        case "3":
          this.steps.step_3 = true;
          break;
      }
    },
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
          .then((data) => {
          for (const step in this.steps) {
            this.steps[step] = false
          }
            this.steps.step_2 = true;
            this.$router.replace('/steps')
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