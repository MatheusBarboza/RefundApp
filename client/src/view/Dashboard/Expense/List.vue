<template>
  <q-page padding>
    <q-table
      title="Expenses"
      :data="data"
      :columns="columns"
      row-key="id"
      @row-click="openItem"
    >
      <template v-slot:top-right>
        <q-btn
          color="primary"
          icon-right="add"
          label="New"
          no-caps
          :to="{ name: 'expensesadd' }"
        />
      </template>
    </q-table>
  </q-page>
</template>

<script>
import ExpenseService from 'src/domains/Expense/Service/ExpenseService'

export default {
  name: 'ExpenseList',
  data () {
    return {
      service: new ExpenseService(),
      data: [],
      columns: [
        {
          name: 'name',
          label: 'Name',
          align: 'left',
          field: 'name'
        }
      ]
    }
  },
  created () {
    this.service.search()
      .then(response => { this.data = response.data })
  },
  methods: {
    openItem (evt, row) {
      const { id } = row
      this.$router.push({ name: 'expensesid', params: { id } })
    }
  }
}
</script>
