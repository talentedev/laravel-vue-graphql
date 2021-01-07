import Vue from 'vue';
import VueRouter from 'vue-router';

import store from '../store';
import Home from '../views/Home';
import Connexion from '../views/Connexion';
import Main from '../views/Main';

Vue.use(VueRouter);

let router = new VueRouter({
    mode: 'history',
    routes: [

        {
            path: '/',
            component: Home,
        },
        {
            path: '/connexion',
            component: Connexion,
        },
        {
            path: '/home',
            component:Main,
            meta: { requiresAuth: true }
        }
    ]
});

router.beforeEach((to, from, next) => {
    if (to.name === 'logout') {
        return SecurityAPI.logout();
    }
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (store.getters['security/isAuthenticated']) {
            next();
        } else {
            next({
                path: '/connexion',
                query: { redirect: to.fullPath }
            });
        }
    } else {
        next(); // make sure to always call next()!
    }
});

export default router;