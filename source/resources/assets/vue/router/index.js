import Vue from 'vue';
import VueRouter from 'vue-router';

import store from '../store';
import Home from '../views/Home';
import Connexion from '../views/Connexion';
import Admin from '../views/Admin';
import Student from '../views/Student';
import Applications from '../views/admin/Applications';
import Schools from '../views/admin/Schools';
import Trainings from '../views/admin/Trainings';
import News from '../views/admin/News';
import Messages from '../views/admin/Messages';
import MyFile from '../views/admin/File';

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
            path: '/admin',
            component: Admin,
            meta: { requiresAuth: true, requiresAdmin: true },
            children: [
                { path: '', redirect: 'applications' },
                { path: 'file', component: MyFile },
                { path: 'applications', component: Applications },
                { path: 'schools', component: Schools },
                { path: 'tranings', component: Trainings },
                { path: 'news', component: News },
                { path: 'messages', component: Messages }
            ]
        },
        {
            path: '/student',
            component: Student,
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

    if (to.matched.some(record => record.meta.requiresAdmin)) {
        if (store.getters['security/isAdmin']) {
            next();
        } else {
            next({
                path: '/student',
            });
        }
    } else {
        next();
    }
});

export default router;