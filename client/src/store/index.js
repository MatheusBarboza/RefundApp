import Vue from 'vue'
import Vuex from 'vuex'

import auth from 'src/modules/Auth/Store'

Vue.use(Vuex)

export let $store

export default function (/* { ssrContext } */) {
  $store = new Vuex.Store({
    modules: {
      auth
    },

    // enable strict mode (adds overhead!)
    // for dev mode only
    strict: process.env.DEV
  })
  return $store
}
