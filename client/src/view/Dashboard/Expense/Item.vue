<template>
  <q-page padding>
    <q-card class="card-size" >
      <q-form
        ref="form"
        @submit="save"
        class="q-gutter-md"
      >
        <q-card-section>
          <div class="text-h6 text-weight-regular">{{ title() }}</div>
        </q-card-section>
        <q-card-section class="q-gutter-md" >
          <app-input
            v-model="record.name"
            label="Name"
            maxlength="30"
            uppercase
            :rules="[ val => val !== null && val.length > 2 || 'The name must contain at least 3 characters' ]"
          />
        </q-card-section>
      </q-form>
      <q-card-actions class="absolute-bottom justify-end" >
        <q-btn color="transparent" text-color="black" icon="reply" label="back" @click="back" />
        <q-space />
        <q-btn color="primary" icon="save" label="save" @click="() => $refs.form.submit()" />
      </q-card-actions>
    </q-card>
  </q-page>
</template>

<script>
import AppInput from 'components/app/AppInput'
import ExpenseService from 'src/domains/Expense/Service/ExpenseService'
import scopeMixin from 'src/domains/General/Mixins/scope'

export default {
  name: 'ExpenseItem',
  components: { AppInput },
  mixins: [scopeMixin],
  data () {
    return {
      service: new ExpenseService(),
      record: {
        name: ''
      }
    }
  },
  mounted () {
    if (!this.isScopeAdd) {
      this.service.read(this.$route.params.id)
        .then(this.loadRecord)
    }
  },
  methods: {
    title () {
      return this.isScopeAdd ? 'Add Expense' : 'Expense'
    },
    save () {
      const action = this.isScopeAdd ? 'create' : 'update'
      this.service[action](this.record)
        .then(({ message }) => {
          this.$message.success(message)
          if (this.isScopeAdd) {
            this.reset()
          }
        }).catch(this.attemptFail)
    },
    attemptFail (error) {
      if (error.errors) {
        return this.$message.errorBanner(error)
      }
      this.$message.error(error.message)
    },
    reset () {
      Object.assign(this.record, this.$options.data.apply(this).record)
      this.$refs.form.reset()
    },
    loadRecord ({ data }) {
      this.record = data
    },
    back () {
      this.$router.go(-1)
    }
  }
}
</script>

<style lang="stylus">
  .card-size
    height calc(100vh - 85px)

</style>
