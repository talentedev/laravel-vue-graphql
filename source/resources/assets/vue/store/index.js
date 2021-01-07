import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from "vuex-persistedstate";

import SecurityModule from './security';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        security: SecurityModule,
    },
    plugins: [createPersistedState()],
});