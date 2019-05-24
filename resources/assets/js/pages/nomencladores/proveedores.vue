<template>
  <crudForm
    :items="proveedores"
    :headers="headers"
    :schema="schema"
    :options="options"
    moduleName="Proveedores"
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
      { text: 'Marca', value: 'marca' },
      { text: 'Serie', value: 'serie', align: 'center' },
      { text: 'Pais', value: 'pais', align: 'center' },
      { text: 'Acciones', value: 'marca', sortable: false, align: 'center' }
    ],
    proveedores: [],
    options: {
      validateAfterChanged: true,
      validateAfterLoad: true
    },
    schema: {
      fields: [
        {
          type: 'input',
          inputType: 'text',
          label: 'Marca',
          model: 'marca',
          validator: 'alpha'
        },
        {
          type: 'select',
          label: 'Serie',
          model: 'serie',
          values: [
            { name: '0', id: '0' },
            { name: '2000', id: '2000' },
            { name: '4000', id: '4000' }
          ]
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Pais',
          model: 'pais'
        }
      ]
    }
  }),

  mounted () {
    if (this.$store.getters.get('proveedores').length === 0) {
      this.$store.dispatch('GET', 'proveedores').then((result) => {
        this.proveedores = this.$store.getters.get('proveedores')
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
      this.proveedores = this.$store.getters.get('proveedores')
    }
  }
}
</script>
