<template>
  <q-page
    class="flex row items-center justify-center"
    padding
  >
    <q-card class="app-login-card">
      <q-card-section class="text-center">
        <div class="text-subtitle1">
          Refund App
        </div>
      </q-card-section>
      <q-separator />
      <q-card-section>
        <q-form greedy @submit="submit" >
          <div class="row q-pa-sm">
            <div class="col-12 ">
              <app-input
                v-model="record.email"
                label="Email"
                type="email"
                :rules="[ val => val !== null && val.length > 0 || 'The email is required' ]"
              >
                <template v-slot:prepend>
                  <q-icon name="mail" />
                </template>
              </app-input>
            </div>
            <div class="col-12 q-pb-md">
              <app-input
                label="Password"
                type="password"
                v-model="record.password"
                :rules="[ val => val !== null && val.length > 0 || 'The password is required' ]"
              >
                <template v-slot:prepend>
                  <q-icon name="vpn_key" />
                </template>
              </app-input>
            </div>
          </div>
          <q-separator />
          <div class="q-pa-sm">
            <q-btn
              class="full-width"
              color="primary"
              label="Sign In"
              size="md"
              type="submit"
            />
            <q-btn
              class="full-width q-mt-xs"
              color="primary"
              label="Sign up"
              size="sm"
              dense
              flat
              @click="signUp"
            />
          </div>
        </q-form>
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script>
import AppInput from 'components/app/AppInput'
import AuthService from 'src/domains/Auth/Service/AuthService'
export default {
  name: 'SignIn',
  components: { AppInput },
  data () {
    return {
      service: new AuthService(),
      record: {
        email: '',
        password: ''
      }
    }
  },
  methods: {
    submit () {
      this.service.signIn(this.record)
        .then(response => {
          this.$store.dispatch('auth/login', response)
            .then(() => this.$router.push('/'))
        })
        .catch(error => {
          if (error.errors) {
            this.$message.errorBanner(error)
          } else {
            this.$message.error(error.message)
          }
        })
    },
    signUp () {
      this.$router.push('signUp')
    }
  }
}
</script>
