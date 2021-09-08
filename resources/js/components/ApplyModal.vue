<template>
  <div
    class="modal fade"
    ref="my_modal"
    :id="'exampleModal' + projectID"
    tabindex="-1"
    :aria-labelledby="'exampleModalLabel' + projectID"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" :id="'exampleModalLabel' + projectID">
            Apply to this Project
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea
                class="form-control"
                id="message-text"
                v-model="message"
              ></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn bg-green text-white"
            data-bs-dismiss="modal"
          >
            Close
          </button>
          <button @click="apply" type="button" class="btn bg-green text-white">
            Apply
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { Modal } from "bootstrap";
export default {
  data() {
    return {
      message: "",
      modal: null,
    };
  },
  mounted() {
    this.modal = new Modal(this.$refs.my_modal);
  },
  props: ["projectID"],
  methods: {
    apply() {
      axios
        .post(location.origin + `/api/project/${this.projectID}/apply`, {
          project_id: this.projectID,
          user_id: this.$store.state.me.id,
          message: this.message,
        })
        .then((res) => {
          this.$store.dispatch("getAllProjects");
          this.modal.hide();
          this.$notify({
            group: "error",
            type: "success",
            title: "Application Succesful",
          });
        })
        .catch((err) => {
          console.error(err);
          this.$errorMessage(err.response.data);
        });
    },
  },
};
</script>
<style scoped>
</style>