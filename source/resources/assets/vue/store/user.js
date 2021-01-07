import _ from 'lodash';
import SecurityAPI from '../api/security';

export default {
    namespaced: true,
    state: {
        isLoading: false,
        error: null,
        isAuthenticated: false,
        id: null,
        nom: null,
        prenom: null,
        email: null,
        telephone: null,
        roles: [],
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
        id (state) {
            return state.id;
        },
        nom (state) {
            return state.nom;
        },
        prenom (state) {
            return state.prenom;
        },
        email (state) {
            return state.email;
        },
        telephone (state) {
            return state.telephone;
        },
        roles (state) {
            return state.roles;
        },
        hasRole (state) {
            return (role, entiteID) => {
                if (state.estAdministrateurCentral) {
                    return true;
                }
                if (_.isNil(state.roles[entiteID])) {
                    return false;
                }
                return state.roles[entiteID].includes(role);
            };
        }
    },
    mutations: {
        ['RESET'](state) {
            state.isLoading = false;
            state.error = null;
            state.isAuthenticated = false;
            state.id = null;
            state.nom = null;
            state.prenom = null;
            state.email = null;
            state.telephone = null;
            state.roles = [];
        },
        ['AUTHENTICATING'](state) {
            state.isLoading = true;
            state.error = null;
            state.isAuthenticated = false;
            state.id = null;
            state.nom = null;
            state.prenom = null;
            state.email = null;
            state.roles = [];
        },
        ['AUTHENTICATING_SUCCESS'](state, payload) {
            state.isLoading = false;
            state.error = null;
            state.isAuthenticated = true;
            state.id = payload.id;
            state.nom = payload.nom;
            state.prenom = payload.prenom;
            state.email = payload.email;
            state.telephone = payload.telephone;
            state.roles = payload.roles;
        },
        ['AUTHENTICATING_ERROR'](state, error) {
            state.isLoading = false;
            state.error = error;
            state.isAuthenticated = false;
            state.id = null;
            state.nom = null;
            state.prenom = null;
            state.email = null;
            state.fonction = null;
            state.telephone = null;
            state.estAdministrateurCentral = false;
            state.estAdministrateurSimulation = false;
            state.droits = [];
            state.roles = [];
        },
        ['PROVIDING_DATA_ON_REFRESH_SUCCESS'](state, payload) {
            state.isLoading = false;
            state.error = null;
            state.isAuthenticated = payload.isAuthenticated;
            state.id = payload.id;
            state.nom = payload.nom;
            state.prenom = payload.prenom;
            state.email = payload.email;
            state.telephone = payload.telephone;
            state.roles = payload.roles;
        },
        ['UPDATE_UTILISATEUR'](state, payload) {
            state.id = payload.id;
            state.nom = payload.nom;
            state.prenom = payload.prenom;
            state.email = payload.email;
            state.telephone = payload.telephone;
        },
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