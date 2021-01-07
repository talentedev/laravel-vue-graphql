import _ from 'lodash';
import SecurityAPI from '../api/security';

export default {
    namespaced: true,
    state: {
        isLoading: false,
        error: null,
        isAuthenticated: false,
        user: null,
        token: null,
    },
    getters: {
        isLoading (state) {
            return state.isLoading;
        },
        hasError (state) {
            return state.error !== null;
        },
        isAuthenticated (state) {
            return state.isAuthenticated;
        },
        getUser (state) {
            return state.user;
        },
        token (state) {
            return state.token;
        },
        isAdmin (state) {
            return state.user && (state.user.role == 'super admin' || state.user.role == 'school admin');
        }
    },
    mutations: {
        ['RESET'](state) {
            state.isLoading = false;
            state.error = null;
            state.isAuthenticated = false;
            state.user = null;
            state.token = null;
            localStorage.setItem('default_auth_token', state.token);
        },
        ['AUTHENTICATING'](state) {
            state.isLoading = true;
            state.error = null;
            state.isAuthenticated = false;
            state.user = null;
            state.token = null;
            localStorage.setItem('default_auth_token', state.token);
        },
        ['AUTHENTICATING_SUCCESS'](state, payload) {
            state.isLoading = false;
            state.error = null;
            state.isAuthenticated = true;
            state.user = payload.user;
            state.token = payload.token;
            localStorage.setItem('default_auth_token', state.token);
        },
        ['AUTHENTICATING_ERROR'](state, error) {
            state.isLoading = false;
            state.error = error;
            state.isAuthenticated = false;
            state.user = null;
            state.token = null;
            localStorage.setItem('default_auth_token', state.token);
        },
        ['PROVIDING_DATA_ON_REFRESH_SUCCESS'](state, payload) {
            state.isLoading = false;
            state.error = null;
            state.isAuthenticated = true;
            state.user = payload.user;
            state.token = payload.access_token;
            localStorage.setItem('default_auth_token', state.token);
        }
    },
    actions: {
        login ({commit}, payload) {
            commit('AUTHENTICATING');
            return SecurityAPI.login(payload.email, payload.password)
                .then(res => commit('AUTHENTICATING_SUCCESS', res.data))
                .catch(err => commit('AUTHENTICATING_ERROR', err));
        },
        logout ({ commit }) {
            commit('RESET');
            return SecurityAPI.logout();
        },
        onRefresh({commit}) {
            commit('PROVIDING_DATA_ON_REFRESH_SUCCESS', payload);
        },
        confirmPassword ({commit}, payload) {
            return SecurityAPI.confirmPassword(payload.token, payload.password);
        }
    },
}