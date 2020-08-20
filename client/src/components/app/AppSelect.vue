<template>
  <q-select ref="input" v-bind:value="value" v-bind="{ outlined, ...$attrs }" v-on="$listeners" />
</template>

<script>
export default {
  name: 'AppSelect',
  props: {
    outlined: {
      default: true
    },
    value: {
      require: true
    }
  },
  methods: {
    focus () {
      this.$refs.input.focus()
    }
  }
}
</script>
