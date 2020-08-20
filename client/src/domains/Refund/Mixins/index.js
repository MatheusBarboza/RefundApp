import RefundService from 'src/domains/Refund/Service/RefundService'

export default {
  data () {
    return {
      service: new RefundService(),
      data: []
    }
  }
}
