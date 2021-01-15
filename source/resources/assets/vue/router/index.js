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
import Dashboard from '../views/admin/Dashboard';
import School from '../views/admin/School';
import Administrators from '../views/admin/Administrators';
import Fields from '../views/admin/Fields';
import MySchool from '../views/admin/MySchool';

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
                { path: '', redirect: 'dashboard' },
                { path: 'dashboard', component: Dashboard },
                { path: 'applications', component: Applications },
                { path: 'schools', component: Schools },
                { path: 'schools/detail/:id?', component: School },
                { path: 'school-profile', component: MySchool },
                { path: 'fields', component: Fields },
                { path: 'tranings', component: Trainings },
                { path: 'administrators', component: Administrators },
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
            if (to.matched.some(record => record.meta.requiresAdmin)) {
                if (store.getters['security/isAdmin']) {
                    next();
                } else {
                    next({
                        path: '/student'
                    });
                }
            } else {
                next();
            }
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