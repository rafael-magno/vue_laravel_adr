// https://vuex.vuejs.org/en/getters.html

export default {
  token (state) {
    return state.token
  },

  user (state) {
    return state.user
  },

  publicPages (state) {
    return state.publicPages
  },

  dialog (state) {
    return state.dialog
  }
}
