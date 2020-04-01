import axios from '@/plugins/axios';

class Repository {
  constructor (url) {
    this.axios = axios;
    this.url = url;
  }

  getAll(page, perPage) {
    let url = this.url + '?page=' + page + '&perPage=' + perPage
    return this.axios.get(url)
  }

  getById(id) {
    return this.axios.get(this.url + '/' + id)
  }

  delete(id) {
    return this.axios.delete(this.url + '/' + id)
  }

  save(data, id = 0) {
    if (id) {
      return this.update(data, id);    
    } else {
      return this.insert(data);
    }
  }

  update(data, id) {
    return this.axios.put(this.url + '/' + id, data)
  }

  insert(data) {
    return this.axios.post(this.url, data)
  }
}

export default Repository;