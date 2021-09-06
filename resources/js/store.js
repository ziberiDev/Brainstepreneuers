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

    },
    projects: {

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
    },
    SET_PROJECTS: (state, payload) => {
        Vue.set(state, 'projects', payload)
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
    getAllProjects({ commit }) {
        axios.get(location.origin + '/api/projects').then(data => {
            commit('SET_PROJECTS', data.data)
        }).catch(err => reject(err))
    },

    getProjectsByAccademy({ commit }, accademyID) {
        axios.get(location.origin + '/api/projects/' + accademyID + '/filter').then(data => {
            console.log(data)
            commit('SET_PROJECTS', data.data)
        }).catch(err => {
            resolve(err)
        })
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
    },
    updateUserSkills: async ({ commit }, skills) => {
        try {
            const data = await axios.post(location.origin + '/api/step-2', {
                skills: skills
            });
            return data;
        } catch (error) {
            return error;
        }
    },
}

export default new Vuex.Store({
    state,
    actions,
    mutations
})