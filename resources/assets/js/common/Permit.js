import _ from 'lodash'

export default {
  methods: {
    can: (permissions) => {
      let response = null
      const userPermissions = this.$store.getters.permissions
      let i = 0
      while (!response) {
        response = permissions.find(p => p === userPermissions[i])
        i = i + 1
      }
      if (response) {
        return true
      }
      return false
    }
  }
}
