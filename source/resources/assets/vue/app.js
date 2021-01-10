import Vue from "vue"

import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/fr';
import 'element-ui/lib/theme-chalk/index.css';

import ApolloClient from 'apollo-boost';
import VueApollo from 'vue-apollo';
import { onError } from 'apollo-link-error';

import App from './App.vue';
import router from './router';
import store from './store';

const apolloClient = new ApolloClient({
  request: async (operation) => {
    operation.setContext({
      headers: {
        Authorization: `Bearer ${localStorage.getItem('default_auth_token')}`,
      },
    });
  },
  // defaultOptions: {
  //   fetchPolicy: 'no-cache'
  // }
  onError(err) {
    console.log(err)
  },
});
const apolloProvider = new VueApollo({
  defaultClient: apolloClient,
});

Vue.use(VueApollo);
Vue.use(ElementUI, { locale });

import AdminWrapper from "./components/layouts/AdminWrapper";
import StudentWrapper from "./components/layouts/StudentWrapper";
Vue.component('admin-wrapper', AdminWrapper);
Vue.component('student-wrapper', StudentWrapper);

new Vue({
    el: '#app',
    router,
    store,
    apolloProvider,
    render: h => h(App),
})
