import { createRouter, createWebHistory } from "vue-router";
import store from "../store/index.js";

const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('../components/Home.vue')
    },
    {
        path: '/about',
        name: 'about',
        component: () => import('../components/About.vue')
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('../components/auth/Login.vue')
    },
    {
        path: '/register',
        name:'register',
        component: () => import('../components/auth/Register.vue')
    },
    {
        path: '/dashboard',
        name:'dashboard',
        component: () => import('../pages/dashboard.vue'),
        meta:{
            requiresAuth: true
        }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.getters['auth/isAuthenticated']) {
        next('/login');
      } else {
        next();
    }
});
export default router;
