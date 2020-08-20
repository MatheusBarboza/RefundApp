<template>
<q-list>
  <q-item-label
    header
    class="text-grey-8"
  >
    Menu
  </q-item-label>
  <template v-for="(item, index) in itemsData" >
    <q-item clickable v-if="permission(item.authorize)" :key="index" :to="{ name: item.route }" exact >
      <q-item-section
        v-if="item.icon"
        avatar
      >
        <q-icon :name="item.icon" />
      </q-item-section>

      <q-item-section>
        <q-item-label>{{ item.title }}</q-item-label>
      </q-item-section>
    </q-item>
  </template>
  <q-item clickable @click="signOut" >
    <q-item-section avatar >
      <q-icon name="power_settings_new" />
    </q-item-section>
    <q-item-section>
      <q-item-label>Sign Out</q-item-label>
    </q-item-section>
  </q-item>
</q-list>
</template>

<script>
import itemsData from './itemsData'
import AuthService from 'src/domains/Auth/Service/AuthService'

export default {
  name: 'ListMenu',
  data () {
    return {
      user: this.$store.getters['auth/getUser'],
      itemsData: itemsData
    }
  },
  methods: {
    permission (authorize) {
      if (!authorize) {
        return true
      }

      return authorize.includes(this.user.role)
    },
    signOut () {
      const service = new AuthService()
      service.signOut()
        .then(() => this.$store.dispatch('auth/logout'))
        .then(() => this.$router.push('/auth'))
        .catch(error => {
          console.warn(error)
          this.$message.error(error.message)
        })
    }
  }
}
</script>
