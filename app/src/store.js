import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersist from 'vuex-persist'

Vue.use(Vuex)

const vuexLocalStorage = new VuexPersist({
  key: 'vuex',
  storage: window.localStorage,
  reducer: state => ({
    user: state.user,
    token: state.token,
  }),
})

export default new Vuex.Store({
  plugins: [vuexLocalStorage.plugin],
  state: {
    barColor: 'rgba(0, 0, 0, .8), rgba(0, 0, 0, .8)',
    barImage: 'https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-1.jpg',
    drawer: null,
    user: '',
    token: false,
    publicPages: ['/login'],
    dialog: {},
  },
  mutations: {
    SET_BAR_IMAGE(state, payload) {
      state.barImage = payload
    },

    SET_DRAWER(state, payload) {
      state.drawer = payload
    },

    SET_TOKEN(state, payload) {
      state.token = payload
    },

    SET_USER(state, payload) {
      state.user = payload
    },

    SET_PUBLIC_PAGES(state, payload) {
      state.publicPages = payload
    },

    SET_DIALOG(state, payload) {
      state.dialog = payload
    },
  },
  actions: {
    setToken({ commit }, payload) {
      commit('SET_TOKEN', payload)
    },

    setUser({ commit }, payload) {
      commit('SET_USER', payload)
    },

    setPublicPages({ commit }, payload) {
      commit('SET_PUBLIC_PAGES', payload)
    },

    openDialogConfirmation({ commit }, payload) {
      const options = payload
      options.title = options.title || 'Confirmation'
      options.type = 'confirmation'
      commit('SET_DIALOG', options)
    },

    openDialogAlert({ commit }, payload) {
      let options = payload
      options = typeof options === 'string' ? { text: options } : options
      options.title = options.title || 'Error'
      options.color = options.color || 'red darken-1'
      options.callback = options.callback || function() {}
      options.type = 'alert'
      commit('SET_DIALOG', options)
    },

    hideDialog({ commit }) {
      commit('SET_DIALOG', {})
    },
  },
  getters: {
    token(state) {
      return state.token
    },
  },
})
