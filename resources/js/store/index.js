import axios from "axios";
import { createStore } from "vuex";

export default createStore({
    state: {
        token: localStorage.getItem('token') || '',
        isAuthenticated: !!localStorage.getItem('token'),
        user: null,
        apiData: null,
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
        },
        UPDATE_AUTH_STATUS(state, status) {
            state.isAuthenticated = status;
        },
        UPDATE_TOKEN(state, token) {
            state.token = token;
            localStorage.setItem('token', token);
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            state.isAuthenticated = !!token; // Automatically update authentication status
        },
        RESET_AUTH(state) {
            state.token = '';
            state.isAuthenticated = false;
            state.user = null;
            localStorage.removeItem('token');
            delete axios.defaults.headers.common['Authorization'];
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
                commit('SET_USER', response.data);
            } catch (error) {
                console.error('Failed to fetch user profile:', error);
            }
        },
        async checkUserAuthenticationStatus({ commit }) {
            try {
                const response = await axios.get('/api/authenticated');
                commit('UPDATE_AUTH_STATUS', response.data.status);
            } catch (error) {
                console.error('Failed to check authentication status:', error);
            }
        },
        setAuthStatus({ commit }, status) {
            commit('UPDATE_AUTH_STATUS', status);
        },
        setAuthToken({ commit }, token) {
            commit('UPDATE_TOKEN', token);
        },
        logout({ commit }) {
            commit('RESET_AUTH');
        },
        async initializeAuth({ commit, dispatch }) {
            const token = localStorage.getItem('token');
            if (token) {
                commit('UPDATE_TOKEN', token);
                try {
                    await dispatch('fetchUser'); 
                    commit('UPDATE_AUTH_STATUS', true);
                } catch {
                    commit('RESET_AUTH');
                }
            }
        }
    },
    getters: {
        authStatus: state => state.isAuthenticated,
        apiData: state => state.apiData,
        user: state => state.user,
        token: state => state.token
    }
});
