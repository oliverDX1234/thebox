import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import modules from './modules'
Vue.use(Vuex)

const store = new Vuex.Store({
    plugins:[
        createPersistedState()
    ],
    state: {
        placeholder: `${process.env.APP_URL}/images/placeholder.png`,
    },
    getters:{
        placeholder: (state) => state.placeholder,
    },
    modules,
    strict: process.env.NODE_ENV !== 'production',
})

export default store

