import axios from "axios";
import Vue from "vue";

import Vuex from "vuex";

Vue.use(Vuex);


const state = {
    me: {

    },
    accademies: {

    },
    skills: {

    }

}

const mutations = {
    SET_ACCADEMIES: (state, payload) => {

        Vue.set(state, 'accademies', payload)

    }
}
const actions = {
    getAccademies: ({ commit }) => {
        axios.get(location.origin + '/api/accademies').then(data => {
            commit('SET_ACCADEMIES', data.data)
        }).catch(error => {
            reject(error);
        });
    }
}

export default  new Vuex.Store({
    state,
    actions,
    mutations
})