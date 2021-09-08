<template>
  <div id="project-container" class="col project-container rounded">
          <ApplyModal :projectID="project.id"></ApplyModal>
    <div class="row">
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

        <div class="float-end">
          <Button
            data-bs-toggle="modal"
            :data-bs-target="'#exampleModal' + project.id"
            >I'm in</Button
          >
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
    };
  },
  components: {
    Button,
    ApplyModal,
  },
  mounted() {},
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
  },
};
</script>
<style lang="scss" scoped>
.project-description {
  transition: opacity 1s ease-out;
  opacity: 0;
}
.project-description.active {
  opacity: 1;
  visibility: visible;
}
.project-description.inactive {
  position: absolute;
  opacity: 0;
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
  // &::after {
  //   content: "Applications";
  //   font-size: 10px;
  //   color: white;
  // }
}

.owner-img {
  margin-top: -55px;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: 8px solid white;
}
.project-container {
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