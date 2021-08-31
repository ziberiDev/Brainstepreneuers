<template>
  <div class="bg-main vh-100">
    <div class="container">
      <div class="row custom-height">
        <div class="col-10 d-flex align-items-center">
          <p class="fs-1">Skills</p>
        </div>
      </div>
    </div>

    <div
      class="
        container-fluid
        position-fixed
        skills
        d-flex
        flex-column
        justify-content-center
      "
    >
      <div
        class="
          row
          skills-container
          justify-content-center
          align-items-center
          row-cols-5
          g-3
        "
      >
        <div class="col" v-for="skill in skills" v-bind:key="skill.id">
          <div
            @click="setSkill(skill.id, $event)"
            ref="skill_btns"
            class="
              bg-light
              d-flex
              justify-content-center
              align-items-center
              skill-btn
              btn
            "
          >
            {{ skill.name }}
          </div>
        </div>
      </div>
      <div class="col-11">
        <Button class="mt-5 float-end">Next</Button>
      </div>
    </div>
  </div>
</template>
<script>
import Button from "../components/Button.vue";
export default {
  data() {
    return {
      selectedSkills: [],
    };
  },
  components: {
    Button,
  },
  computed: {
    skills() {
      return this.$store.state.skills;
    },
  },
  mounted() {
    this.$store.dispatch("getSkills");
  },
  methods: {
    setSkill(id, event) {
      let clickedElement = this.$refs["skill_btns"][id - 1];
      if (this.selectedSkills.length == 10) {
        if (clickedElement.className.includes("bg-green")) {
          this.toggleButton(clickedElement);

          for (const key in this.selectedSkills) {
            if (this.selectedSkills[key] == id) {
              this.selectedSkills.splice(key, 1);
              return;
            }
          }
        }
        this.$notify({
          group: "error",
          type: "error",
          title: "Please seletct between 4 and 10 skills",
        });
        return;
      }

      if (clickedElement.className.includes("bg-green")) {
        this.toggleButton(clickedElement);

        for (const key in this.selectedSkills) {
          if (this.selectedSkills[key] == id) {
            this.selectedSkills.splice(key, 1);
            return;
          }
        }
      }
      this.toggleButton(clickedElement);
      this.selectedSkills.push(id);
    },
    toggleButton(clickedElement) {
      clickedElement.classList.toggle("bg-green");
      clickedElement.classList.toggle("bg-light");
      clickedElement.classList.toggle("text-light");
    },
  },
};
</script>
<style scoped>
.skills {
  height: 100%;
}

.skills-container {
  height: 50%;
  overflow-y: scroll;
  margin: 0 100px;
}
.skill-btn {
  max-height: 140px;
  min-width: 100px;
  padding: 0 50px;
  height: 80px;
}
.skills-container::-webkit-scrollbar {
  width: 15px;
  border: 1.5px solid #dd7f1e;
}
/* Handle */
.skills-container::-webkit-scrollbar-thumb {
  background: #dd7f1e;
  height: 50%;
}
</style>
    
