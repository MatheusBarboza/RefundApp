import { route } from 'src/utils/Router'

const signIn = () => import('src/view/Auth/SignIn')
const signUp = () => import('src/view/Auth/SignUp')

export const routes = (router) => [
  route('signIn', signIn),
  route('signUp', signUp)
]
