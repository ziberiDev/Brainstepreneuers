

   const routes = [
      { path: '',name: 'login' , component: () => import('../Views/Login.vue') },
      { path: '/register',name: 'register' , component: () => import('../Views/Register.vue') },

    ]

export default routes;