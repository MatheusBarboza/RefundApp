<template>
  <q-page
    class="flex row items-center justify-center"
    padding
  >
    <q-card class="app-login-card">
      <q-card-section class="text-center">
        <div class="text-subtitle1">
          Refund App - Sign Up
        </div>
      </q-card-section>
      <q-separator />
      <q-card-section>
        <q-form greedy @submit="submit" >
          <div class="row q-pa-sm">
            <div class="col-12">
              <app-input
                v-model="record.name"
                label="Name"
                :rules="[ val => val !== null && val.length > 2 || 'The name must contain at least 3 characters' ]"
                maxlength="30"
              />
            </div>
            <div class="col-12">
              <app-input
                v-model="record.email"
                label="Email"
                type="email"
                :rules="[ val => val !== null && val.length > 0 || 'The email is required' ]"
              />
            </div>
            <div class="col-12">
              <app-input
                label="Password"
                type="password"
                v-model="record.password"
                :rules="[ val => val !== null && val.length > 0 || 'The password is required' ]"
                maxlength="20"
              />
            </div>
            <div class="col-12 q-pb-md">
              <app-input
                label="Confirm Password"
                type="password"
                v-model="record.password_confirmation"
                :rules="[
                  val => val !== null && val.length > 0 || 'The confirmation password is required',
                  val => val === record.password || 'The passowords not match'
                ]"
                maxlength="20"
              />
            </div>
            <div class="col-12 row justify-center" >
              <q-radio v-model="record.role" :val="0" label="Manager" />
              <q-radio v-model="record.role" :val="1" label="Employer" />
            </div>
          </div>
          <q-separator />
          <div class="q-pa-sm">
            <q-btn
              class="full-width"
              color="primary"
              label="Sign Up"
              size="md"
              type="submit"
            />
            <q-btn
              class="full-width q-mt-xs"
              color="primary"
              label="back"
              size="sm"
              dense
              flat
              @click="back"
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
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        role: 0
      }
    }
  },
  methods: {
    submit () {
      this.service.signUp(this.record)
        .then(response => {
          this.$message.success(response.message)
          this.$router.push('signIn')
        })
        .catch(error => {
          if (error.errors) {
            this.$message.errorBanner(error)
          } else {
            this.$message.error(error.message)
          }
        })
    },
    back () {
      this.$router.go(-1)
    }
  }
}
</script>
