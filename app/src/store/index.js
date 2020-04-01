/**
 * Vuex
 *
 * @library
 *
 * https://vuex.vuejs.org/en/
 */

// Lib imports
import Vue from 'vue'
import Vuex from 'vuex'

// Store functionality
import actions from './actions'
import getters from './getters'
import modules from './modules'
import mutations from './mutations'
import state from './state'
import VuexPersist from 'vuex-persist'

Vue.use(Vuex)

const vuexLocalStorage = new VuexPersist({
  key: 'vuex',
  storage: window.localStorage,
  reducer: state => ({
    user: state.user,
    token: state.token
  })
})

// Create a new store
const store = new Vuex.Store({
  plugins: [vuexLocalStorage.plugin],
  actions,
  getters,
  modules,
  mutations,
  state
})

export default store
