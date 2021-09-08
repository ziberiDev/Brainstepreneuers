

   const routes = [
      { path: '/',name: 'login' , component: () => import('../Views/Login.vue') },
      { path: '/register',name: 'register' , component: () => import('../Views/Register.vue') },
      { path: '/step_1',name: 'step_1' , component: () => import('../Views/Step_1.vue') },
      { path: '/step_2',name: 'step_2' , component: () => import('../Views/Step_2.vue') },
      { path: '/step_3',name: 'step_3' , component: () => import('../Views/Step_3.vue') },
      { path: '/brainsterprenuers',name: 'home' , component: () => import('../Views/Home.vue') },
      { path: '/project',name: 'project' , component: () => import('../Views/Home.vue') },

    ]

export default routes;