<template>
  <q-input ref="input" v-bind:value="value" v-bind="{ outlined, ...$attrs }" v-on="inputListeners" />
</template>

<script>
export default {
  name: 'AppInput',
  props: {
    outlined: {
      default: true
    },
    value: {
      require: true
    },
    uppercase: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    inputListeners: function () {
      if (!this.uppercase) {
        return this.$listeners
      }

      return Object.assign({},
        this.$listeners,
        {
          input: this.setUpperCase
        }
      )
    }
  },
  methods: {
    focus () {
      this.$refs.input.focus()
    },
    setUpperCase (val) {
      this.$emit('input', val.toUpperCase())
    }
  }
}
</script>
