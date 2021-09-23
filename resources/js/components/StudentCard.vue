  <template>
  <div class="col mt-5">
    <div
      class="rounded"
      :class="application.accepted != null ? 'bg-gray' : 'bg-white'"
    >
      <div class="text-center">
        <img class="student-img" :src="application.student.image" alt="" />
      </div>
      <div class="text-center">
        <p class="fs-3 fw-bold mb-1">
          {{ application.student.first_name }}
          {{ application.student.last_name }}
        </p>
        <p
          class="text-orange fw-bolder m-0"
          v-text="this.$positionExcerpt(application.student.accademy.name)"
        ></p>
        <small>
          {{ application.student.email }}
        </small>
        <div class="my-3">
          <p>{{ application.message }}</p>
        </div>
        <div>
          <button
            :disabled="application.accepted != null ? true : false"
            @click="acceptApplication(application.id)"
            class="btn fs-2"
          >
            +
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["application"],
  data() {
    return {};
  },
  mounted() {},
  methods: {
    acceptApplication(applicationID) {
      this.$store
        .dispatch("acceptApplication", applicationID)
        .then((response) => {
          console.log(response);
        });
    },
  },
};
</script>
<style scoped>
.student-img {
  margin-top: -55px;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: 8px solid white;
}
</style>