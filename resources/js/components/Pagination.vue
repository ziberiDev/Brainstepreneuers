<template>
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li
        v-for="(link, index) in pagination.links"
        :key="index"
        class="page-item"
      >
        <button
          :disabled="link.url && link.active != true ? false : true"
          :class="
            link.active
              ? 'page-link orange-bg text-green'
              : 'page-link bg-green'
          "
          @click="getPage(link.url)"
          v-html="link.label"
        ></button>
      </li>
    </ul>
  </nav>
</template>
<script>
import axios from "axios";
import Vue from "vue";
export default {
  props: ["pagination"],
  data() {
    return {};
  },
  methods: {
    getPage(url) {
        if (!url) {
          return;
        }
      axios.get(url).then((data) => {
        let container = document.getElementById("projects-container");
        container.scroll({ top: 0, behavior: "smooth" });
        Vue.set(this.$store.state, "pagination", data.data.meta);
        Vue.set(this.$store.state, "projects", data.data.projects);
      });
    },
  },
};
</script>
<style scoped>
.active {
  background-color: white;
}
.page-link {
  color: white;
}
</style>