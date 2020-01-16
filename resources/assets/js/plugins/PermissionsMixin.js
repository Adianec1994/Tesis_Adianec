import Vue from 'vue'

Vue.mixin({
  data() {
    return {
      permissions: []
    }
  },
  mounted() {},
  methods: {
    allowed(model, permission) {
      this.permissions = this.$store.getters.get('permissions')
      console.log(this.permissions)

      return this.permissions[model + '-' + permission]
    }
  }
})
