import Http from './Http'

export default class Rest extends Http {
    resource = ''

    /**
     * @param {Object} record
     * @returns {Promise}
    */
    create (record) {
      return this.post('', record)
    }

    /**
     * @param {Object} record
     * @returns {Promise}
     */
    update (record) {
      return this.put(`/${this.__getId(record)}`, record)
    }

    /**
     * @param {String|Object} record
     * @returns {Promise}
     */
    read (record) {
      return this.get(`/${this.__getId(record)}`)
    }

    /**
     * @param {Object} record
     * @returns {Promise}
     */
    destroy (record) {
      return this.delete(`/${this.__getId(record)}`)
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

    /**
     * @param {Object} params
     * @returns {Promise}
     */
    search (params = {}) {
      return this.get('', { params })
    }
}
