<template>
  <div class="container-fluid vh-100 bg-login">
    <div class="row vh-100">
      <div class="col-8 h-100">
        <div class="margin">
          <p class="fs-1 fw-bold me-4">
            <span class="black-font">Brainsters</span
            ><span class="gray-font">Preneuers</span>
          </p>
          <p class="fs-2">Propel your ideas to life!</p>
        </div>
      </div>
      <div class="col-4">
        <form class="h-100 d-flex" action="">
          <div class="d-flex w-75 flex-column justify-content-center">
            <p class="fs-1 fw-bold font-black">Login</p>
            <input
              v-model="email"
              type="text"
              name="email"
              id="email"
              placeholder="email"
            />
            <input
              v-model="password"
              class="mt-3"
              type="password"
              name="password"
              id="password"
              placeholder="password"
            />
            <button
              @click.prevent="login"
              class="
                btn btn-rounded
                w-50
                align-self-end
                mt-3
                orange-bg
                text-light
              "
            >
              Login
            </button>
            <div class="mt-3">
              <p>
                Don't have an account, register
                <router-link to="/register">here</router-link>
              </p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  mounted() {},
  computed: {
    me() {
      return this.$store.state.me;
    },
  },
  methods: {
    login() {
      axios
        .post(location.origin + "/api/login", {
          email: this.email,
          password: this.password,
        })
        .then((data) => {
          console.log(data);
          this.$store.dispatch("getMe").then(() => {
            if (this.me.registered == 0) {
              this.$router.replace("/step_" + this.me.step);
            } else {
              this.$router.push({ name: "home" });
            }
          });
        })
        .catch((err) => {
          if (err) {
            this.$errorMessage(err.response.data);
          }
        });
    },
  },
};
</script>
<style scoped>
.margin {
  margin: 200px;
}
.bg-login {
  background-image: url("../assets/bg-images/1.jpg");
  background-repeat: no-repeat;
  background-size: 100% 100%;
  background-position: center;
}
</style>>

