<template>
  <div class="container-fluid vh-100 bg-register">
    <div class="row vh-100">
      <div class="col-12 col-md-10 d-flex align-items-center ps-5 mt-5">
        <form @submit.prevent="register" class="w-100">
          <p class="fs-2 mb-5">Register</p>
          <div class="row">
            <div class="col-12 col-md-3">
              <input
                type="text"
                v-model="first_name"
                placeholder="First name"
              />
            </div>
            <div class="col-12 col-md-3">
              <input type="text" v-model="last_name" placeholder="Last name" />
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-12 col-md-3">
              <input type="email" v-model="email" placeholder="First name" />
            </div>
            <div class="col-12 col-md-3">
              <input
                type="password"
                v-model="password"
                placeholder="Last name"
              />
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-8 col-md-5">
              <textarea
                v-model="biography"
                class="w-100"
                cols="30"
                rows="6"
                placeholder="Biography 
 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries"
              ></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-3">
              <Button>Next</Button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import Button from "../components/Button.vue";
export default {
  data() {
    return {
      first_name: "",
      last_name: "",
      email: "",
      password: "",
      biography: "",
    };
  },
  components: {
    Button,
  },
  mounted() {
    // this.$router.go('/steps')
  },
  methods: {
    register() {
      console.log("hello");
      axios
        .post(location.origin + "/api/register", {
          first_name: this.first_name,
          last_name: this.last_name,
          email: this.email,
          password: this.password,
          biography: this.biography,
        })
        .then((response) => {
          this.$router.replace("/steps?step=1");
        })
        .catch((err) => {
          if (err) {
            this.printErrorMessages(err.response.data);
          }
        });
    },
    printErrorMessages(error) {
      let errorMessages = "";
      const messages = error.errors;
      for (const key in messages) {
        for (const message of messages[key]) {
          errorMessages += `<li>${message}</li>`;
        }
      }
      this.$notify({
        group: "error",
        type: "error",
        ignoreDuplicates: true,
        title: error.message,
        text: `<ul>${errorMessages}</ul>`,
      });
    },
  },
};
</script>
<style scoped>
.bg-register {
  background-image: url("../assets/bg-images/2.jpg");
  background-repeat: no-repeat;
  background-size: 100% 100%;
  background-position: center;
}
</style>
    
