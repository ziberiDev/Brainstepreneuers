<template>
  <div class="bg-main vh-100">
    <div class="container">
      <div class="row">
        <div class="col-10 d-flex align-items-center">
          <p class="fs-1">Skills</p>
          <ImageUploader
            :debug="1"
            :maxWidth="512"
            :quality="0.7"
            :autoRotate="false"
            outputFormat="file"
            :preview="true"
            :className="['fileinput', { 'fileinput--loaded': hasImage }]"
            :capture="false"
            accept="image/*"
            @input="setImage"
          >
            <label for="fileInput" slot="upload-label">
              <figure>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="32"
                  height="32"
                  viewBox="0 0 32 32"
                >
                  <path
                    class="path1"
                    d="M9.5 19c0 3.59 2.91 6.5 6.5 6.5s6.5-2.91 6.5-6.5-2.91-6.5-6.5-6.5-6.5 2.91-6.5 6.5zM30 8h-7c-0.5-2-1-4-3-4h-8c-2 0-2.5 2-3 4h-7c-1.1 0-2 0.9-2 2v18c0 1.1 0.9 2 2 2h28c1.1 0 2-0.9 2-2v-18c0-1.1-0.9-2-2-2zM16 27.875c-4.902 0-8.875-3.973-8.875-8.875s3.973-8.875 8.875-8.875c4.902 0 8.875 3.973 8.875 8.875s-3.973 8.875-8.875 8.875zM30 14h-4v-2h4v2z"
                  ></path>
                </svg>
              </figure>
              <span class="upload-caption">{{
                hasImage ? "Replace" : "Upload"
              }}</span>
            </label>
          </ImageUploader>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Vue from 'vue'
import ImageUploader from "vue-image-upload-resize";
Vue.use(ImageUploader)

export default {
  data() {
    return {
      hasImage: false,
      image: null,
    };
  },
  components: {
    ImageUploader,
  },
  mounted() {
    //   this.$router.go("step_2")
   let img=  document.getElementsByClassName('img-preview')
  console.log(img.styles)
  img[0].style.display = 'inline'
  img[0].src = '../images/1.jpg'
  },
  methods: {
    setImage: function (file) {
      console.log(file);
      this.hasImage = true;
      this.image = file;
    },
  },
};
</script>
<style>
.img-preview {
  height: 250px ;
  width: 250px ;
  border-radius: 50%;
  border: 5px solid white;

}
#fileInput {
  display: none !important;
}
</style>