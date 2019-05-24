<template>
  <crudForm
    :items="provincias"
    :headers="headers"
    :schema="schema"
    :options="options"
    moduleName="Provincias"
  >
  </crudForm>
</template>

<script>
import crudForm from '../../components/crud'
import { mapGetters } from 'vuex'

export default {
  components: {
    crudForm
  },
  data: () => ({
    dialog: false,
    headers: [
      { text: 'Nombre', value: 'nombre' },
      { text: 'Acciones', value: 'marca', sortable: false, align: 'center' }
    ],
    provincias: [],
    options: {
      validateAfterChanged: true,
      validateAfterLoad: true
    },
    schema: {
      fields: [
        {
          type: 'input',
          inputType: 'text',
          label: 'Nombre de la provincia',
          model: 'nombre'
        }
      ]
    }
  }),

  computed: {
    // ...mapGetters({
    //   provincias: `get('provincias')`
    // })
  },

  mounted () {
    if (this.$store.getters.get('provincias').length === 0) {
      this.$store.dispatch('GET', 'provincias').then((result) => {
        this.provincias = this.$store.getters.get('provincias')
        this.$store.dispatch('responseMessage', {
          type: result.success ? 'success' : 'error',
          text: result.message
        })
      }).catch((err) => {
        this.$store.dispatch('responseMessage', {
          type: 'error',
          text: err
        })
      })
    } else {
      this.provincias = this.$store.getters.get('provincias')
    }
  }
}
</script>
