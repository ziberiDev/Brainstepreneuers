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
              Don't have an account, register <router-link to="/register">here</router-link>
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
      bg_login:{

      }
    };
  },
  mounted() {
  
  },
  methods: {
    login() {
      axios
        .post(location.origin + "/api/login", {
          email: this.email,
          password: this.password,
        })
        .then((data) => console.log(data))
        .catch((err) => {
          console.log(err.response.data);
          this.printErrorMessages(err.response.data);
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
input#email,
input#password {
  font-size: 20px;
  border: none;
  background-color: transparent;
  border-bottom: 5px solid black;
  border-radius: 5%;
}
input#email,
input#password:focus {
  outline: none;
}
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

