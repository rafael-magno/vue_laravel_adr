// https://vuex.vuejs.org/en/actions.html

export default {
  setToken ({ commit }, payload) {
    commit('SET_TOKEN', payload)
  },

  setUser ({ commit }, payload) {
    commit('SET_USER', payload)
  },

  setPublicPages ({ commit }, payload) {
    commit('SET_PUBLIC_PAGES', payload)
  },

  openDialogConfirmation ({ commit }, payload) {
    let options = payload
    options.title = options.title || 'Confirmation'
    options.type = 'confirmation'
    commit('SET_DIALOG', options)
  },

  openDialogAlert ({ commit }, payload) {
    let options = payload
    options = typeof options === 'string' ? { text: options } : options
    options.title = options.title || 'Error'
    options.color = options.color || 'red darken-1'
    options.callback = options.callback || function () {}
    options.type = 'alert'
    commit('SET_DIALOG', options)
  },

  hideDialog ({ commit }) {
    commit('SET_DIALOG', {})
  }
}
