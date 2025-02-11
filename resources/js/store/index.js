import axios from "axios";
import { createStore } from "vuex";

export default createStore({
    state: {
        token: localStorage.getItem('token') || '',
        isAuthenticated: false,
        user: null,
        apiData: null,
    },
    mutations: {
        SET_API_DATA(state, data) {
            state.apiData = data;
        },
        SET_USER(state, user) {
            state.user = user;
        },
        UpdateAuthenticationStatus(state, status) {
            state.isAuthenticated = status;
        },
        UpdateAuthStatus(state, status) {
            state.isAuthenticated = status;
        },
        UpdateToken(state, token) {
            state.token = token;
            localStorage.setItem('token', token);
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        },
        resetAuth(state) {
            state.token = null;
            state.isAuthenticated = false;
        },
    },
    actions: {
        async fetchApiData({ commit }) {
            try {
                const response = await axios.get('/api/api-data');
                commit('SET_API_DATA', response.data);
            } catch (error) {
                console.error('Failed to fetch API data:', error);
            }
        },
        async fetchUser({ commit }) {
            try {
                const response = await axios.get('/api/user');
                const user = response.data;
                if (user && user.name) {
                    commit('SET_USER', user);
                } else {
                    throw new Error('User data is invalid');
                }
            } catch (error) {
                console.error('Failed to fetch user profile:', error);
            }
        },
        checkUserAuthenticationStatus({ commit }) {
            axios.get('/api/authenticated')
                .then(response => {
                    commit('UpdateAuthenticationStatus', response.data.status);
                })
                .catch(error => {
                    console.error('Failed to check authentication status:', error);
                });
        },
        setAuthStatus({ commit }, status) {
            commit('UpdateAuthStatus', status);
        },
        setAuthToken({ commit }, token) {
            commit('UpdateToken', token);
        },
        logout({ commit }) {
            commit('resetAuth');
            localStorage.removeItem('token');
            delete axios.defaults.headers.common['Authorization'];
        },
        initializeAuth({ commit }) {
            const token = localStorage.getItem('token');
            if (token) {
                commit('UpdateToken', token);
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                commit('UpdateAuthenticationStatus', true);
                commit('fetchUser');
            }
        }
    },
    getters: {
        authStatus: state => state.isAuthenticated,
        apiData: state => state.apiData,
    }
});
