import axios from 'axios'
import store from '../store'

const $axios = axios.create({
  baseURL: process.env.VUE_APP_API_URL || null,
  withCredentials: true,
})
$axios.interceptors.request.use((config) => {
  console.log(config)

  return config
}, error => Promise.reject(error))
$axios.interceptors.response.use(
  (response) => response,
  (error) => {
    error.serverMessages = {}
    if (error.response) {
      let sendToLogin = error.response.status === 401
      sendToLogin &= error.response.data.messages[0] === 'INVALID_TOKEN'
      if (sendToLogin) {
        window.location.assign('/auth/login')
      } else if (error.response.status === 422 && error.response.data.messages) {
        error.serverMessages = error.response.data.messages
        if (Array.isArray(error.serverMessages)) {
          store.dispatch('openDialogAlert', error.serverMessages[0])
        }
      } else if (error.response.status >= 500) {
        store.dispatch('openDialogAlert', 'Unexpected error, please refresh the page and try again.')
      }
    }
    return Promise.reject(error)
  },
)

export default $axios
