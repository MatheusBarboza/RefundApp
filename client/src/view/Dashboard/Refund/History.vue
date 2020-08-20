<template>
  <q-page padding>
    <q-table
      title="Refunds History"
      :data="data"
      :columns="columns"
      row-key="id"
      @row-click="openItem"
    >
      <template v-slot:body-cell-status="props">
        <q-td :props="props">
          <q-chip v-if="props.value === 1" color="positive" text-color="white" icon="check">
            approved
          </q-chip>
          <q-chip v-if="props.value === 2" color="negative" text-color="white" icon="close">
            rejected
          </q-chip>
        </q-td>
      </template>
    </q-table>
  </q-page>
</template>

<script>
import mixin from 'src/domains/Refund/Mixins'

export default {
  name: 'RefundHistory',
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
        },
        {
          name: 'status',
          label: 'Status',
          field: 'status',
          align: 'right'
        }
      ]
    }
  },
  created () {
    this.service.history()
      .then(response => { this.data = response.data })
  },
  methods: {
    openItem (evt, row) {
      const { id } = row
      this.$router.push({ name: 'refundshistoryid', params: { id } })
    }
  }
}
</script>
