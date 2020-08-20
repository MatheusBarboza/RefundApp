import { erase, write } from 'src/utils/Storage'

/**
 * @param state
 * @param token
 */
export const mutateToken = (state, token) => {
  state.token = token
  if (token) {
    write('token', state.token, true)
    return
  }
  erase('token')
}

/**
 * @param state
 * @param user
 */
export const mutateUser = (state, user) => {
  state.user = user
  if (user) {
    write('user', state.user, true)
    return
  }
  erase('user')
}
