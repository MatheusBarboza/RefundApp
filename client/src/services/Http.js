import Http from './standard'

/**
 * @type {Rest}
 */
export default class Rest {
    /**
     * @type {string}
     */
    resource = ''

    /**
     * @type {Http}
    */
    http = undefined

    constructor () {
      this.http = Http
    }

    /**
     * @param {string} url
     * @returns {*|AxiosPromise<any>}
     */
    get (url = '', params = {}) {
      return this.http.get(`${this.resource}${url}`, params)
    }

    /**
     * @param {string} url
     * @param {Object} data
     * @returns {*|AxiosPromise<any>}
     */
    post (url = '', data = {}) {
      return this.http.post(`${this.resource}${url}`, data)
    }

    /**
     * @param {string} url
     * @param {Object} data
     * @returns {*|AxiosPromise<any>}
     */
    put (url = '', data = {}) {
      return this.http.put(`${this.resource}${url}`, data)
    }

    /**
     * @param {string} url
     * @returns {*|AxiosPromise<any>}
     */
    delete (url = '') {
      return this.http.delete(`${this.resource}${url}`)
    }

    /**
     * @param {String|Object} record
     * @returns {string}
     */
    __getId (record) {
      if (typeof record === 'object') {
        return record.id
      }

      return String(record)
    }
}
