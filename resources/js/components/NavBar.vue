<template>
  <nav
    id="navbar"
    class="navbar navbar-expand-lg navbar-light bg-light nav-border"
  >
    <div class="container-fluid">
      <router-link class="navbar-brand fs-2" :to="{ name: 'home' }"
        ><span class="black-font">Brainster</span
        ><span class="gray-font">Prenesuers</span></router-link
      >
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div
        class="collapse navbar-collapse justify-content-end"
        id="navbarSupportedContent"
      >
        <ul
          v-if="this.$route.name == 'MyProfile'"
          class="navbar-nav w-100 justify-content-end me-4 mb-2 mb-lg-0"
        >
          <li class="nav-item">
            <router-link
              class="text-dark text-decoration-none fw-bold fs-4"
              :to="{ name: 'MyProfile', params: { page: 'projects' } }"
              :class="this.$route.params.page == 'projects' ? 'text-muted' : ''"
              >My Projects</router-link
            >
          </li>
          <li class="nav-item">
            <router-link
              class="text-dark text-decoration-none fw-bold fs-4"
              :to="{ name: 'MyProfile', params: { page: 'applications' } }"
              :class="
                this.$route.params.page == 'applications' ? 'text-muted' : ''
              "
              >My Applications</router-link
            >
          </li>
          <li class="nav-item">
            <router-link
              class="text-dark text-decoration-none fw-bold fs-4"
              :to="{ name: 'MyProfile', params: { page: 'profile' } }"
              :class="this.$route.params.page == 'profile' ? 'text-muted' : ''"
              >My Profile</router-link
            >
          </li>
        </ul>
      </div>
    </div>
    <div>
      <router-link :to="{ name: 'MyProfile', params: { page: 'projects' } }">
        <div
          @mouseover="logout = true"
          @mouseleave="logout = false"
          class="float-end me-5 mx-sm-auto"
        >
          <img class="user-image" :src="this.me.image" alt="user image" />
        </div>
      </router-link>
      <div class="position-absolute logout-btn" v-if="logout">
        <p>Logout</p>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "navbar",
  data() {
    return {
      name: "Denis",
      logout: false,
    };
  },
  computed: {
    me() {
      return this.$store.state.me;
    },
  },
  mounted() {
    this.$store.dispatch("getMe");
    this.$store.dispatch("getAccademies");
  },
};
</script>
<style lang="scss" scoped>
.nav-border {
  border-bottom: 3px solid #dd7f1e;
}
.user-image {
  height: 70px;
  width: 70px;
  margin: 0 auto;
  border-radius: 50%;
  border: 5px solid white;
}
.navbar-nav {
  .nav-item {
    margin: 0 25px;
  }
}
.logout-btn {
  bottom: 50px;
}
</style>
