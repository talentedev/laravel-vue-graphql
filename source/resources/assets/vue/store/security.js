import _ from 'lodash';
import SecurityAPI from '../api/security';

export default {
    namespaced: true,
    state: {
        isLoading: false,
        error: null,
        isAuthenticated: false,
        token: null,
    },
    getters: {
        isLoading (state) {
            return state.isLoading;
        },
        hasError (state) {
            return state.error !== null;
        },
        error (state) {
            return state.error;
        },
        isAuthenticated (state) {
            return state.isAuthenticated;
        },
        token (state) {
            return state.roles;
        }
    },
    mutations: {
        ['RESET'](state) {
            state.isLoading = false;
            state.error = null;
            state.isAuthenticated = false;
            state.token = null;
            localStorage.setItem('default_auth_token', state.token);
        },
        ['AUTHENTICATING'](state) {
            state.isLoading = true;
            state.error = null;
            state.isAuthenticated = false;
            state.token = null;
            localStorage.setItem('default_auth_token', state.token);
        },
        ['AUTHENTICATING_SUCCESS'](state, payload) {
            state.isLoading = false;
            state.error = null;
            state.isAuthenticated = true;
            state.token = payload.access_token;
            localStorage.setItem('default_auth_token', state.token);
        },
        ['AUTHENTICATING_ERROR'](state, error) {
            state.isLoading = false;
            state.error = error;
            state.isAuthenticated = false;
            state.token = null;
            localStorage.setItem('default_auth_token', state.token);
        },
        ['PROVIDING_DATA_ON_REFRESH_SUCCESS'](state, payload) {
            state.isLoading = false;
            state.error = null;
            state.isAuthenticated = payload.isAuthenticated;
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
        onRefresh({commit}, payload) {
            commit('PROVIDING_DATA_ON_REFRESH_SUCCESS', payload);
        },
        confirmPassword ({commit}, payload) {
            return SecurityAPI.confirmPassword(payload.token, payload.password);
        },
        updateUtilisateur({commit}, payload) {
            commit('UPDATE_UTILISATEUR', payload);
        }
    },
}