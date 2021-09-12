<template>
  <div
    id="myProjects"
    class="container-fluid"
    :class="projects == true ? 'bg-projects' : ''"
  >
    <div v-if="projects == true">
      <div class="row">
        <div class="col-12">
          <p class="fs-4 fw-bold">Have new idea to make the world better?</p>
          <p class="fs-2">
            Create new project
            <span @click="projects = false" class="fs-1 add-project-btn"
              >+</span
            >
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-9 mx-auto">
          <div
            id="projects-container"
            class="row projects-container"
          >
            <Project
              class="my-5"
              v-for="(project, index) in myProjects"
              :key="index + 'project'"
              :project="project"
            >
            </Project>
          </div>
        </div>
      </div>
    </div>
    <!-- add Projects  -->
    <div v-if="projects == false" class="row p-4 h-100">
      <div class="col-6">
        <p class="fs-3 fw-bold">New Project</p>
        <form @submit.prevent="register" class="w-100 mt-5">
          <div class="row">
            <div class="col-12 col-md-3">
              <input
                type="text"
                v-model="project_name"
                placeholder="Name of project"
              />
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-10">
              <textarea
                v-model="description"
                class="w-100"
                cols="30"
                rows="6"
                placeholder="Description of Project
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries"
              ></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="col-6 h-100 d-flex flex-column">
        <p class="fs-3 fw-bold">What i need</p>
        <div class="row row-cols-4 justify-content-center">
          <AccademyButton
            :padding="'50px 0'"
            ref="accademy_btns"
            @click.native="selectAccademy($event, accademy.id)"
            class="mt-5"
            v-for="accademy in accademies"
            :key="accademy.id + 'accademy'"
            :accademy="accademy"
          />
        </div>
        <small class="align-self-end m-5 text-orange fw-bold"
          >Please select no more tha 4 options</small
        >
        <div class="align-self-end">
          <Button @click.native="createProject" class="mt-auto">Create</Button>
          <Button
            @click.native="
              projects = true;
              selectedAccademies = [];
            "
            class="mt-auto"
            >Back</Button
          >
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import AccademyButton from "../components/AccademyButton.vue";
import Button from "../components/Button.vue";
import Project from "../components/Project.vue";
export default {
  props: ["myProjects"],
  data() {
    return {
      projects: true,
      project_name: "",
      description: "",
      selectedAccademies: [],
    };
  },
  components: {
    Project,
    AccademyButton,
    Button,
  },
  computed: {
    accademies() {
      return this.$store.state.accademies;
    },
  },
  mounted() {
    this.calculateHeight();

    window.addEventListener("resize", () => {
      this.calculateHeight();

      //   console.log("resized")
    });
  },
  methods: {
    calculateHeight() {
      let navbar = document.getElementById("navbar");
      let container = document.getElementById("myProjects");

      container.style.height =
        document.body.clientHeight - 18 - navbar.clientHeight + "px";
    },
    selectAccademy(event, accID) {
      let selected = this.$refs["accademy_btns"][accID - 1].$el.children[0];
      if (this.selectedAccademies.length == 4) {
        if (selected.className.includes("bg-green")) {
          this.toggleButton(selected);
          for (const key in this.selectedAccademies) {
            if (this.selectedAccademies[key] == accID) {
              this.selectedAccademies.splice(key, 1);
              return;
            }
          }
        }
        this.$notify({
          group: "error",
          type: "error",
          title: "Please select no morte than 4 options",
        });
        return;
      }
      if (selected.className.includes("bg-green")) {
        this.toggleButton(selected);

        for (const key in this.selectedAccademies) {
          if (this.selectedAccademies[key] == accID) {
            this.selectedAccademies.splice(key, 1);
            return;
          }
        }
      }
      this.toggleButton(selected);
      this.selectedAccademies.push(accID);
    },

    toggleButton(clickedElement) {
      clickedElement.classList.toggle("bg-green");
      clickedElement.classList.toggle("bg-light");
      clickedElement.classList.toggle("text-light");
    },
    createProject() {
      let form = new FormData();
      form.append("name", this.project_name);
      form.append("description", this.description);
      this.selectedAccademies.forEach((accademy) => {
        form.append("accademies[]", accademy);
      });
      this.$store.dispatch("createProject", form).then((data) => {
        console.log(data);
        if (data.status != 200) {
          this.$errorMessage(data.data);
          return;
        }
        this.projects = true;
        this.project_name = "";
        this.description = "";
        this.selectedAccademies = [];
        this.$notify({
          group: "error",
          type: "success",
          title: "Project Created",
        });
      });
    },
  },
};
</script>
<style lang="scss" scoped>
.bg-projects {
  // height: 100%;
  background-image: url("../assets/bg-images/4.jpg");
  background-repeat: no-repeat;
  background-size: 100% 100%;
  //   background-position: center;
}
.projects-container {
  padding: 50px 0;
  overflow-y: scroll;
  height: 65vh;
  &::-webkit-scrollbar {
    display: none;
  }
}
.add-project-btn {
  cursor: pointer;
}
</style>