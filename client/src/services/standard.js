import axios from 'axios'
import { erase, write } from 'src/utils/Storage'
import { $router } from 'src/router'
import { $store } from 'src/store'
const TOKEN_NAME = 'token'

const standard = axios.create({
  baseURL: process.env.api.BASE_URL,
  timeout: 100000
})

export const setToken = token => {
  if (token) {
    const replace = `Bearer ${token.replace('Bearer ', '')}`
    updateToken(replace)
    return
  }
  updateToken('')
  erase(TOKEN_NAME)
}

export const updateToken = (token) => {
  standard.defaults.headers.common.Authorization = token
  write(TOKEN_NAME, token)
}

/**
 * @param config
 * @returns {*}
 */
const requestOnFulfilled = function (config) {
  const token = $store.getters['auth/getToken']
  config.headers.common.Authorization = `Bearer ${token}`
  return config
}

/**
 * @param error
 * @returns {Promise<never>}
 */
const requestOnRejected = function (error) {
  // Do something with request error
  return Promise.reject(error)
}
/**
 */
standard.interceptors.request.use(requestOnFulfilled, requestOnRejected)

/**
 * @param response
 * @returns {*}
 */
const responseOnFulfilled = function (response) {
  // Do something with response data
  return response.data
}

/**
 * @param error
 * @returns {Promise}
 */
const responseOnRejected = function (error) {
  if (!error.response) {
    return Promise.reject(error)
  }

  if (error.response && [401, 403].includes(error.response.status)) {
    $store.dispatch('auth/logout').then(() => {
      $router.push({ name: 'login' })
    })
  }

  if (error.response.data) {
    return Promise.reject(error.response.data)
  }

  return Promise.reject(error)
}

standard.interceptors.response.use(responseOnFulfilled, responseOnRejected)

export default standard
