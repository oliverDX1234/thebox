import Vue from 'vue'
import Vuex from 'vuex'
import modules from './modules'
Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        placeholder: `${process.env.MIX_APP_URL}/images/upload.png`,
    },
    getters:{
        placeholder: (state) => state.placeholder,
    },
    modules,
    strict: process.env.NODE_ENV !== 'production',
})

export default store

