import { SCOPES } from 'src/utils/Enum'

export default {
  computed: {
    isScopeIndex () {
      return this.__getScope() === SCOPES.SCOPE_INDEX
    },
    isScopeAdd () {
      return this.__getScope() === SCOPES.SCOPE_ADD
    },
    isScopeEdit () {
      return this.__getScope() === SCOPES.SCOPE_EDIT
    },
    isScopeReadOny () {
      return this.__getScope() === SCOPES.SCOPE_READONLY
    }
  },
  methods: {
    __getScope () {
      const { scope } = this.$route.meta
      return scope
    }
  }
}
