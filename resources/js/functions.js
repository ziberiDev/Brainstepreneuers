import Vue from 'vue'


export const positionExcerpt =  Vue.prototype.$positionExcerpt = function (position) {
  switch (position) {
    case "Backend Development":
      return "Backend Developer";

    case "Frontend Development":
      return "Frontend Developer";

    case "Marketing":
      return "Marketer";

    case "Data Science":
      return "Data Scientist";

    case "Design":
      return "Designer";

    case "QA":
      return "QA Tester";

    case "UX/UI":
      return "UX/UI Designer";
  }
}

const errorMessage =  Vue.prototype.$errorMessage = function (error) {
  let errorMessages = "";
  const messages = error.errors;
  for (const key in messages) {
    for (const message of messages[key]) {
      errorMessages += `<li>${message}</li>`;
    }
  }
  this.$notify({
    group: "error",
    type: "error",
    ignoreDuplicates: true,
    title: error.message,
    text: `<ul>${errorMessages}</ul>`,
  });
}

export default global = {
  errorMessage,
  positionExcerpt
}
