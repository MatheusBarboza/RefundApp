<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated class="bg-gradient" >
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"
        />

        <q-toolbar-title>
          Refund App
        </q-toolbar-title>

      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      content-class="bg-grey-1"
    >
      <ListMenu />
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import ListMenu from './components/ListMenu.vue'

export default {
  name: 'DashboardLayout',
  components: { ListMenu },
  data () {
    return {
      leftDrawerOpen: false
    }
  }
}
</script>
