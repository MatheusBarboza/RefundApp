import { group, redirect } from 'src/utils/Router'
import { routes as auth } from 'src/domains/Auth/Routes'

export default (router) => {
  const routes = [
    group({
      path: '/auth',
      component: () => import('src/modules/Auth/AuthLayout'),
      children: [
        redirect('', 'signIn'),
        ...auth(router)
      ]
    })
  ]
  router.addRoutes(routes)
}
