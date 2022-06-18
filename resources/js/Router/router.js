import Vue from 'vue'
import VueRouter from "vue-router";
import store from "../store";
import routes from "./routes";
Vue.use(VueRouter)

const router = new VueRouter({
    base: process.env.BASE_URL,
    mode: 'history',
    routes
})
router.beforeEach((to, from, next) => {

    if (to.matched.some(record => record.meta.requiresLogin) && !store.state.authenticated) {
        // You can use store variable here to access globalError or commit mutation 
        next({ path: '/' })
    } else {
        next()
    }


})
export default router