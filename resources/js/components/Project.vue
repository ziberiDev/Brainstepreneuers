<template>
  <div
    class="col-12"
    @mouseenter="$route.name != 'home' && !options ? (options = true) : ''"
    @mouseleave="$route.name != 'home' && options ? (options = false) : ''"
  >
    <div class="project-container h-100 pe-3 rounded">
      <ApplyModal :projectID="project.id"></ApplyModal>
      <div class="row h-100">
        <div class="col-4 position-relative">
          <div class="text-center">
            <img class="owner-img" :src="project.owner.image" alt="" />
            <p class="text-center m-0">
              {{ project.owner.first_name }} {{ project.owner.last_name }}
            </p>
            <p
              class="text-orange fw-bolder"
              v-text="
                'I am a ' + this.$positionExcerpt(project.owner.accademy.name)
              "
            ></p>
          </div>
          <div
            class="
              d-flex
              w-100
              position-absolute
              bottom-0
              align-items-end
              justify-content-center
            "
          >
            <div v-for="(accademy, index) in project.accademies" :key="index">
              <p
                class="accademy-text m-0 text-center circle bg-green"
                v-text="Accademyexcerpt(accademy.name)"
              ></p>
            </div>
          </div>
        </div>
        <div class="col-8 py-2 position-relative">
          <div>
            <span>{{ project.name }}</span>
            <div
              class="
                d-flex
                align-items-center
                applications-container
                bg-green
                float-end
              "
            >
              <p>
                {{ project.applications }}
                <span>Applications</span>
              </p>
            </div>
            <p
              class="project-description"
              :class="[!readMore ? 'active' : 'inactive']"
            >
              {{ project.description.slice(0, 300) + "..." }}
            </p>
            <p
              class="project-description"
              :class="[readMore ? 'active' : 'inactive']"
            >
              {{ project.description }}
            </p>
            <p
              class="show-btn text-orange text-end"
              @click="readMore = !readMore ? true : false"
            >
              {{ readMore ? "show less" : "read more..." }}
            </p>
          </div>
          <div v-if="this.$route.name != 'MyProfile'" class="float-end">
            <Button
              data-bs-toggle="modal"
              :data-bs-target="'#exampleModal' + project.id"
              >I'm in</Button
            >
          </div>
          <div
            v-if="options"
            class="project-options position-absolute d-flex flex-column"
          >
            <img
              @click="deleteProject(project.id)"
              style="height: 40px; width: 25px"
              src="/images/delete.png"
              alt="icon"
            />
            <img
              @click="editProject(project.id)"
              style="height: 30px; width: 25px; margin-top: 25px"
              src="/images/edit.png"
              alt="icon"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Button from "../components/Button.vue";
import ApplyModal from "../components/ApplyModal.vue";
export default {
  props: {
    project: { type: Object },
  },
  data() {
    return {
      readMore: false,
      showModal: false,
      options: false,
    };
  },
  components: {
    Button,
    ApplyModal,
  },
  mounted() {
    if (this.project.description.length < 300) {
      this.readMore = true;
    }
  },
  methods: {
    Accademyexcerpt(accademyName) {
      switch (accademyName) {
        case "Backend Development":
          return "Backend  Dev";

        case "Frontend Development":
          return "Frontend Dev";

        default:
          return accademyName;
      }
    },
    deleteProject(projectID) {},
    editProject(projectID) {},
  },
};
</script>
<style lang="scss" scoped>
.project-description {
  transition: opacity 1s ease-out, max-height 1s ease-out;
  max-height: 150px;
  opacity: 0;
}
.project-description.active {
  opacity: 1;
  max-height: 150px;
  visibility: visible;
}
.project-description.inactive {
  position: absolute;
  opacity: 0;
  max-height: 100px;
  visibility: hidden;
}
.text-orange {
  font-size: 12px;
}
.show-btn {
  cursor: pointer;
}
.applications-container {
  margin-top: -35px;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  text-align: center;
  color: white;
  & > p {
    margin: 0;
    font-size: 10px;
  }
}
.project-options {
  // margin-right: -250px;
  right: -45px;
  bottom: 45px;
  float: right;
  & > img {
    cursor: pointer;
  }
}
.owner-img {
  margin-top: -55px;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: 8px solid white;
}
.project-container {
  min-height: 200px;
  width: 90%;
  background-color: white;
}
.accademy-text {
  font-size: 11px;
}
.circle {
  width: 65px;
  height: 35px;
  padding: 5px 10px 10px 10px;
  color: white;
  border-top-left-radius: 100px; /* 100px of height + 10px of border */
  border-top-right-radius: 100px; /* 100px of height + 10px of border */
  border-bottom: 0;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
</style>