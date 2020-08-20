import Vue from 'vue'
import VueRouter from 'vue-router'

import auth from 'src/modules/Auth/Routes'
import dashboard from 'src/modules/Dashboard/Routes'

Vue.use(VueRouter)

export let $router

export default function (/* { store, ssrContext } */) {
  const options = {
    scrollBehavior: () => ({ x: 0, y: 0 }),
    // Leave these as they are and change in quasar.conf.js instead!
    // quasar.conf.js -> build -> vueRouterMode
    // quasar.conf.js -> build -> publicPath
    mode: process.env.VUE_ROUTER_MODE,
    base: process.env.VUE_ROUTER_BASE
  }

  $router = new VueRouter(options)
  auth($router)
  dashboard($router)

  return $router
}
