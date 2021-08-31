import axios from "axios";
import { reject } from "lodash";
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
    },
    SET_USER: (state, payload) => {
        Vue.set(state, 'me', payload)
    },
    SET_SKILLS: (state, payload) => {
        Vue.set(state, 'skills', payload)
    }
}
const actions = {
    getAccademies: ({ commit }) => {
        axios.get(location.origin + '/api/accademies').then(data => {
            commit('SET_ACCADEMIES', data.data)
        }).catch(error => {
            reject(error);
        });
    },

    getMe: async ({ commit }) => {
        try {
            const data = await axios.get(location.origin + '/api/me');
            commit('SET_USER', data.data);
        } catch (error) {
            reject(error);
        }
    },
    getSkills: ({ commit }) => {
        axios.get(location.origin + '/api/skills').then(data => {
            commit('SET_SKILLS', data.data)
        }).catch(error => {
            reject(error)
        })
    }
}

export default new Vuex.Store({
    state,
    actions,
    mutations
})