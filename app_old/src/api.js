import axios from 'axios';
//import store from './store';

const headers = {};
/*const addAuthorization = !store.getters.publicPages.includes(window.location.pathname);
if (addAuthorization) {
  headers.Authorization = `Bearer ${store.getters.token}`;
}*/

axios.interceptors.response.use(function (response) {
  return response;
}, function (error) {
  console.log(error);
  alert('Ocorreu um erro inesperado, favor tentar novamente!');
  return Promise.reject(error);
});

const api = axios.create({
  baseURL: window.baseURL || process.env.VUE_APP_API_URL || null,
  headers,
});


export default api;
