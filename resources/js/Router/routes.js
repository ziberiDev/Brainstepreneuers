

const routes = [
   { path: '*', name: '404', component: () => import('../Views/404.vue') },
   { path: '/', name: 'login', component: () => import('../Views/Login.vue'), meta: { requiresLogin: false } },
   { path: '/register', name: 'register', component: () => import('../Views/Register.vue'), meta: { requiresLogin: false } },
   { path: '/step_1', name: 'step_1', component: () => import('../Views/Step_1.vue'), meta: { requiresLogin: true } },
   { path: '/step_2', name: 'step_2', component: () => import('../Views/Step_2.vue'), meta: { requiresLogin: true } },
   { path: '/step_3', name: 'step_3', component: () => import('../Views/Step_3.vue'), meta: { requiresLogin: true } },
   { path: '/brainsterprenuers', name: 'home', component: () => import('../Views/Home.vue'), meta: { requiresLogin: true } },
   { path: '/myprofile/:page', name: 'MyProfile', component: () => import('../Views/MyProfile.vue'), props: true, meta: { requiresLogin: true } },
   // { path: '/pageNotFound', name: "404", },

]

export default routes;