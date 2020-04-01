import Vue from 'vue'

// Lib imports
import axios from 'axios'

import store from '../store'

let $axios = axios.create({
  baseURL: process.env.VUE_APP_API_URL || null
})

$axios.interceptors.request.use((config) => {
  const addAuthorization = !store.getters.publicPages.includes(window.location.pathname)
  if (addAuthorization && store.getters.token) {
    // eslint-disable-next-line no-param-reassign
    config.headers.Authorization = `Bearer ${store.getters.token}`
  }

  return config
}, error => Promise.reject(error))

$axios.interceptors.response.use(
  (response) => {
    if (response.headers && response.headers['x-refresh-token']) {
      store.dispatch('setToken', response.headers['x-refresh-token'])
    }
    return response.data
  },
  (error) => {
    error.serverMessages = {}
    if (error.response) {
      if (error.response.status === 401) {
        window.location.assign('/login')
      } else if (error.response.status === 422 && error.response.data.messages) {
        error.serverMessages = error.response.data.messages
        if (Array.isArray(error.serverMessages)) {
          store.dispatch('openDialogAlert', error.serverMessages[0])
        }
      } else {
        store.dispatch('openDialogAlert', 'Unexpected error, please refresh the page and try again.')
      }
    }
    return Promise.reject(error)
  }
)

export default $axios
