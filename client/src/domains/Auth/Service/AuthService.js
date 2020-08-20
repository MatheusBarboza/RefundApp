import Http from 'src/services/Http'

/**
 * @type {AuthService}
 */
export default class AuthService extends Http {
    resource = '/auth'

    /**
     * @param {Object} params
     * @returns {Promise}
    */
    signIn (params) {
      return this.post('/signIn', params)
    }

    /**
     * @param {Object} params
     * @returns {Promise}
    */
    signUp (params) {
      return this.post('/signUp', params)
    }

    /**
     * @returns {Promise}
    */
    signOut () {
      return this.get('/signOut')
    }
}
