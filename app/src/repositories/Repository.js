import axios from '@/plugins/axios'

class Repository {
  constructor(url) {
    this.axios = axios
    this.url = url
  }

  async getAll(page = 1, perPage = 1000) {
    const url = this.url + '?page=' + page + '&perPage=' + perPage
    const response = await this.axios.get(url)
    const responseData = response.data

    if (typeof this.dataFormat === 'function') {
      responseData.data = responseData.data.map(element => this.dataFormat(element))
    }

    return responseData
  }

  async getById(id) {
    const response = await this.axios.get(this.url + '/' + id)
    let responseData = response.data

    if (typeof this.dataFormat === 'function') {
      responseData = this.dataFormat(responseData)
    }

    return responseData
  }

  delete(id) {
    return this.axios.delete(this.url + '/' + id)
  }

  save(data, id = 0) {
    if (id) {
      return this.update(data, id)
    } else {
      return this.insert(data)
    }
  }

  update(data, id) {
    return this.axios.put(this.url + '/' + id, data)
  }

  insert(data) {
    return this.axios.post(this.url, data)
  }
}

export default Repository
