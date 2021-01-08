import axios from 'axios';
import store from '../store';

export default {
    login (email, password) {
        return axios.post(
            '/api/security/login',
            {
                email: email,
                password: password
            }
        );
    },
    logout () {
        return axios.get('/api/security/logout', {
            header: {
                Authorization: `Bearer ${localStorage.getItem('default_auth_token')}`,
            }
        });
    },
    confirmPassword (token, password) {
        return axios.post(
            '/api/security/token',
            {
                token: token,
                password: password
            }
        );
    },
    resetPassword (email) {
        return axios.post(
            '/api/security/reset-password',
            {
                email: email
            }
        );
    }
}