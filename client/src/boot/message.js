import { Notify } from 'quasar'

/**
 * @param {Object} options
 * @param {Object} action
 * @returns {*}
 */
const base = (options, action = {}) => {
  const defaults = {
    color: '',
    textColor: '',
    icon: '',
    message: '',
    position: 'bottom-right',
    timeout: 3000,
    actions: [
      {
        icon: 'close',
        color: 'white',
        handler: () => undefined,
        ...action
      }
    ]
  }
  return {
    ...defaults,
    ...options
  }
}

/**
 * @param {string} message
 * @param options
 */
export const success = (message, options = {}) => {
  Notify.create(base({ message, ...options, color: 'positive', icon: 'check_circle' }))
}

/**
 * @param {string} message
 * @param options
 */
export const error = (message, options = {}) => {
  Notify.create(base({ message, ...options, color: 'negative', icon: 'warning' }))
}

/**
 * @param {string} error
 */
export const errorBanner = (error) => {
  const options = { multiLine: true, html: true }
  const fullMessage = '<strong>' + error.message + '</strong><br /><br />' + Object.values(error.errors).join('<br/>')

  Notify.create(base({ message: fullMessage, ...options, color: 'negative', icon: 'warning', position: 'bottom', timeout: 7000 }))
}

/**
 * @param Vue
 * @returns {Object}
 */
export default ({ Vue }) => {
  /**
   */
  Object.defineProperty(Vue.prototype, '$message', {
    get () {
      return {
        success, error, errorBanner
      }
    }
  })
}
