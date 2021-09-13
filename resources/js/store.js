import axios from "axios";
import { reject } from "lodash";
import Vue from "vue";
import global from './functions.js'



import Vuex from "vuex";

Vue.use(Vuex);
Vue.use(global)



const state = {
    me: {
        projects: {},
        applications: {}
    },
    accademies: {

    },
    skills: {

    },
    projects: {

    },
    pagination: {

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
    },
    SET_MY_PROJECTS: (state, payload) => {
        Vue.set(state.me, 'projects', payload)
    },
    UPDATE_MY_PROJECTS: (state, payload) => {
        state.me.projects.push(payload)
    },
    SET_PAGINATION: (state, payload) => {
        Vue.set(state, 'pagination', payload)
    },
    DELETE_MY_PROJECT: (state, Pid) => {

        try {
            for (const key of state.me.projects) {
                if (key.id == Pid) {
                    state.me.projects.splice(key, 1)
                    return
                }
            }
        } catch (error) {
            console.log(error)
        }
    }
}
const actions = {
    createProject: async ({ commit }, form) => {
        // console.log(form.getAll('accademies[]'))
        // return

        try {
            const res = await axios.post(location.origin + '/api/user/project/create', form);
            commit('UPDATE_MY_PROJECTS', res.data.project[0])
            return res
        } catch (err) {
            if (err) {
                return err.response
            }
        }
    },
    getAccademies: ({ commit }) => {
        axios.get(location.origin + '/api/accademies').then(data => {
            commit('SET_ACCADEMIES', data.data)
        }).catch(error => {
            reject(error);
        });
    },
    getAllProjects({ commit }) {
        axios.get(location.origin + '/api/projects').then(data => {
            commit('SET_PROJECTS', data.data.projects)
            commit('SET_PAGINATION', data.data.meta)


        }).catch(err => reject(err))
    },

    getProjectsByAccademy({ commit }, accademyID) {
        axios.get(location.origin + '/api/projects/' + accademyID + '/filter').then(data => {
            console.log(data)
            commit('SET_PROJECTS', data.data.projects)
            commit('SET_PAGINATION', data.data.meta)
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
    getMyProjects: ({ commit }) => {
        axios.get(location.origin + '/api/me/projects')
            .then(data => {
                commit('SET_MY_PROJECTS', data.data)
            }).catch(err => {
                reject(err)
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
    deleteProject: ({ commit }, projectID) => {

        axios.delete(`/api/project/${projectID}/delete`).then(data => {
            commit('DELETE_MY_PROJECT', projectID);
        }).catch(err => {
            reject(err)
        })



    }
}

export default new Vuex.Store({
    state,
    actions,
    mutations
})