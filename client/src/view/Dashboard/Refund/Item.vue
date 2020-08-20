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
            :readonly="!isScopeAdd"
          />
          <app-input
            v-model.number="record.price"
            type="number"
            label="Price"
            :rules="[ val => val !== null && val > 0 || 'The price must be higher than 0' ]"
            @input="val => record.price = val !== null ? Number(val).toFixed(2) : val"
            :readonly="!isScopeAdd"
          />
          <app-select
            v-model="record.expenses"
            :options="options"
            label="Expenses"
            map-options
            emit-value
            multiple
            clearable
            :rules="[ val => val.length > 0 || 'At least one expense is required' ]"
            :readonly="!isScopeAdd"
          />
        </q-card-section>
      </q-form>
      <q-card-actions class="absolute-bottom justify-end" >
        <q-btn color="transparent" text-color="black" icon="reply" label="back" @click="back" />
        <q-space />
        <q-btn v-if="isScopeAdd" color="primary" icon="save" label="save" @click="() => $refs.form.submit()" />
        <template v-if="isScopeEdit" >
          <q-btn color="negative" icon="close" label="reject" @click="approve(2)" />
          <q-btn color="positive" icon="check" label="approve" @click="approve(1)" />
        </template>
      </q-card-actions>
    </q-card>
  </q-page>
</template>

<script>
import AppInput from 'components/app/AppInput'
import AppSelect from 'components/app/AppSelect'
import RefundService from 'src/domains/Refund/Service/RefundService'
import ExpenseService from 'src/domains/Expense/Service/ExpenseService'
import scopeMixin from 'src/domains/General/Mixins/scope'

export default {
  name: 'RefundItem',
  components: { AppInput, AppSelect },
  mixins: [scopeMixin],
  data () {
    return {
      service: new RefundService(),
      supportService: new ExpenseService(),
      record: {
        name: '',
        price: 0,
        expenses: []
      },
      options: []
    }
  },
  mounted () {
    this.supportService.search().then(this.refactoryOptions)
    if (!this.isScopeAdd) {
      this.service.read(this.$route.params.id)
        .then(this.loadRecord)
    }
  },
  methods: {
    title () {
      return this.isScopeAdd ? 'New Refund' : this.isScopeEdit ? 'Repayment Assessment' : 'Refund'
    },
    save () {
      this.service.create(this.record)
        .then(({ message }) => {
          this.$message.success(message)
          this.reset()
        }).catch(this.attemptFail)
    },
    approve (status) {
      this.service.update({ id: this.record.id, status })
        .then(({ message }) => {
          this.$message.success(message)
          this.back()
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
    refactoryOptions ({ data }) {
      data.forEach(element => {
        this.options.push({
          label: element.name,
          value: element.id
        })
      })
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
