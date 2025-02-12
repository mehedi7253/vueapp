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
    },
    {
        path: '/add-product',
        name: 'Add New Product',
        component: () => import('../pages/product/create.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/all-product',
        name: 'All Product',
        component: () => import('../pages/product/index.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/edit-product/:productId',
        name: 'EditProduct',
        component: () => import('../pages/product/edit.vue'),
        meta: {
            requiresAuth: true
        }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = store.getters.authStatus;
    if (to.meta.requiresAuth && !isAuthenticated) {
        next('/login');
    } else if ((to.name === 'login' || to.name === 'register') && isAuthenticated) {
        next('/dashboard');
    } else {
        next();
    }
});
export default router;
