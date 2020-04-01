// https://vuex.vuejs.org/en/mutations.html

export default {
  SET_TOKEN (state, payload) {
    state.token = payload
  },

  SET_USER (state, payload) {
    state.user = payload
  },

  SET_PUBLIC_PAGES (state, payload) {
    state.publicPages = payload
  },

  SET_DIALOG (state, payload) {
    state.dialog = payload
  }
}
