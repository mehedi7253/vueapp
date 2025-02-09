import { createStore } from 'vuex'
const store = createStore({
    state: {
        toke: localStorage.getItem('token') || null,
        userProfile: null,
    },
    mutations: {
        SET_TOKEN(state, token) {
            state.toke = token
            localStorage.setItem('token', token)
        },
        CLEAR_TOKEN(state) {
            state.token = null
            localStorage.removeItem('token')
        },
        SET_USER_PROFILE(state, profile) {
            state.userProfile = profile
        }
    },
    actions: {
        login({ commit }, token){
            commit('SET_TOKEN', token)
        },
        logout({ commit }) {
            commit('CLEAR_TOKEN')
        },
        async fetchUserProfile({ commit, state }) {
            if (state.token) {
                try{
                    const response = await axios.get('/api/user',{
                        headers: { Authorization: `Bearer ${state.token}` }
                    })
                    commit('SET_USER_PROFILE', response.data)
                } catch (error) {
                    console.error(error)
                }
            }
        }
    },

    getters:{
        isLoggedIn: state => state.token !== null,
        userProfile: state => state.userProfile
    }
})
