//impliment login registration store with token

import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        token: localStorage.getItem('token'),
        user: null
    },
    mutations: {
        SET_TOKEN(state, token) {
            state.token = token
            if(token) {
                localStorage.setItem('token', token)
            } else {
                localStorage.removeItem('token')
            }
        },
        SET_USER(state, user) {
            state.user = user
        }
    },
    actions: {
        login({commit}, user) {
            return axios.post('/login', user).then(({data}) => {
                commit('SET_TOKEN', data.token)
                commit('SET_USER', data.user)
            })
        },
        logout({commit}) {
            return axios.post('/logout').then(() => {
                commit('SET_TOKEN', null)
                commit('SET_USER', null)
            })
        },
        register({commit}, user) {
            return axios.post('/register', user).then(({data}) => {
                commit('SET_TOKEN', data.token)
                commit('SET_USER', data.user)
            })
        }
    }
})


