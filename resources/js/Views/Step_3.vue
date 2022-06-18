<template>
  <div class="bg-main">
    <div class="container-fluid">
      <div class="row position-fixed start-0 end-0">
        <div class="col-10 mx-auto my-5">
          <div class="fs-1 fw-bold">
            <span>Your profile image</span>
            <div class="line orange-bg"></div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="
        container
        d-flex
        flex-column
        justify-content-center
        align-items-center
        vh-100
      "
    >
      <div class="row w-100">
        <div class="col-5 mx-auto">
          <ImageUploader
            class="d-flex flex-column text-center"
            :debug="1"
            :maxWidth="512"
            :quality="0.7"
            :autoRotate="false"
            outputFormat="file"
            :preview="true"
            :className="['fileinput', { 'fileinput--loaded': hasImage }]"
            :capture="false"
            accept="image/.jpg,.jpeg,.png"
            @input="setImage"
          >
            <label for="fileInput" slot="upload-label">
              <div class="upload-caption mt-3 fs-5">
                Click here to {{ hasImage ? "Replace this" : "Upload" }} Image
              </div>
            </label>
          </ImageUploader>
        </div>
      </div>
      <div class="col-6 mt-5 mx-auto text-center">
        <Button @click.native="uploadImage()">Finish</Button>
      </div>
    </div>
  </div>
</template>
<script>
import FormData from "form-data";
import Button from "../components/Button.vue";
// import Vue from "vue";
import ImageUploader from "vue-image-upload-resize";
// Vue.use(ImageUploader);

export default {
  data() {
    return {
      hasImage: false,
      image: null,
    };
  },
  components: {
    ImageUploader,
    Button,
  },
  mounted() {
    //   this.$router.go("step_2")
    let img = document.getElementsByClassName("img-preview");
    console.log(img.styles);
    img[0].style.display = "inline";
    img[0].src = "../images/1.jpg";
  },
  methods: {
    setImage: function (file) {
      console.log(file);
      if (
        file.type != "image/png" &&
        file.type != "image/jpg" &&
        file.type != "image/jpeg"
      ) {
        this.$notify({
          group: "error",
          type: "error",
          title: "Please upload a valid image (.jpg , .jpeg or .png)",
        });
        return;
      }
      this.hasImage = true;
      this.image = file;
    },
    uploadImage() {
      if (this.image) {
        let data = new FormData();
        data.append("image", this.image, this.image.name);
        axios
          .post(location.origin + "/api/step-3", data)
          .then((data) => {
            console.log(data);
            this.$router.push({ name: "home" });
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
  },
};
</script>
<style>
.upload-caption {
  cursor: pointer;
}
.img-preview {
  height: 250px;
  width: 250px;
  margin: 0 auto;
  border-radius: 50%;
  border: 15px solid white;
}
#fileInput {
  display: none !important;
}
</style>