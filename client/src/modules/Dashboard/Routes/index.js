import { fallback, group } from 'src/utils/Router'
import { routes as refund } from 'src/domains/Refund/Route'
import { routes as expense } from 'src/domains/Expense/Route'
import { $store } from 'src/store'

/**
 * @param {AppRouter} router
 * @returns {Array}
 */
export default (router) => {
  const routes = [
    group({
      path: '/',
      component: () => import('src/modules/Dashboard/Layout/DashboardLayout'),
      children: [
        fallback(() => import('src/view/Dashboard/Index')),
        ...refund(router),
        ...expense(router)
      ]
    })
  ]

  router.addRoutes(routes)
  // Always leave this as last one
  if (process.env.MODE !== 'ssr') {
    routes.push({
      path: '/*',
      component: () => import('src/view/Dashboard/Error404')
    })
  }

  router.beforeEach((to, from, next) => {
    const { authorize } = to.meta
    const { role } = $store.getters['auth/getUser']

    console.warn(to)
    if (to.path.includes('auth')) {
      next()
      return
    }

    if (!$store.getters['auth/getToken']) {
      next('/auth')
      return
    }

    if (authorize && !authorize.includes(role)) {
      from()
      return
    }

    next()
  })
}
