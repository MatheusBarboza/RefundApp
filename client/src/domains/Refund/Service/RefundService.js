import Rest from 'src/services/Rest'

export default class RefundService extends Rest {
    resource = '/refunds'

    /**
     * @returns {Promise}
     */
    history () {
      return this.search({ status: 1 })
    }
}
