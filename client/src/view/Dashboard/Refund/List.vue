<template>
  <q-page padding>
    <q-table
      title="Refunds Pending"
      :data="data"
      :columns="columns"
      row-key="id"
      @row-click="openItem"
    />
  </q-page>
</template>

<script>
import mixin from 'src/domains/Refund/Mixins'

export default {
  name: 'RefundList',
  mixins: [mixin],
  data () {
    return {
      columns: [
        {
          name: 'name',
          label: 'Name',
          align: 'left',
          field: 'name'
        },
        {
          name: 'price',
          label: 'Price',
          field: 'price',
          align: 'center'
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
      this.$router.push({ name: 'refundsid', params: { id } })
    }
  }
}
</script>
