import { SCOPES } from 'src/utils/Enum'

/**
 * @param {string} path
 * @param {string} redirect
 * @param {Object} meta
 * @returns {Object}
 */
export const redirect = (
  path,
  redirect,
  meta = {}
) => ({ path, redirect, meta })

/**
 * @param {string} path
 * @param {Function} component
 * @param {Array} children
 * @param {Object} meta
 * @returns {Object}
 */
export const group = ({
  path,
  component,
  children = [],
  meta = {},
  ...params
}) => ({ path, component, children, meta, ...params })

/**
 * @param {string} path
 * @param {Function} component
 * @param {Object} meta
 * @param {string} name
 * @param {Object} props
 * @returns {Object}
 */
export const route = (
  path,
  component,
  meta = {},
  name = undefined,
  props = false
) => ({ path, name, component, meta, props })

/**
 * @param {string} path
 * @param {Function} component
 * @param {Object} props
 * @param {Object} meta
 * @returns {Object}
 */
export const props = (
  path,
  component,
  props = {},
  meta = {}
) => ({ path, component, props, meta })

/**
 * @param {Function} component
 * @param {Object} meta
 * @returns {Object}
 */
export const fallback = (component, meta = {}) => route('', component, meta)

/**
 * @param domain
 * @param list
 * @param form
 * @param authorization
 * @returns {Array}
 */
export const crud = (domain, list, form, authorization) => {
  return [
    route(`/${domain}`, list, { scope: SCOPES.SCOPE_INDEX, authorization: authorization.list }, `${domain}`),
    route(`/${domain}/add`, form, { scope: SCOPES.SCOPE_ADD, authorization: authorization.add }, `${domain}add`),
    route(`/${domain}/:id`, form, { scope: SCOPES.SCOPE_EDIT, authorization: authorization.edit }, `${domain}id`)
  ]
}

/**
 * @param list
 * @param add
 * @param edit
 * @returns {Object}
 */
export const crudAuthorization = (list, add, edit) => {
  return { list, add, edit }
}
