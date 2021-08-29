

   const routes = [
      { path: '',name: 'login' , component: () => import('../Views/Login.vue') },
      { path: '/register',name: 'register' , component: () => import('../Views/Register.vue') },
      { path: '/steps',name: 'steps' , component: () => import('../Views/Steps.vue') },

    ]

export default routes;