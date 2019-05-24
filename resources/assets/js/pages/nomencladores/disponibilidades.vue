<template>
  <crudForm
    :items="disponibilidades"
    :headers="headers"
    :schema="schema"
    :options="options"
    moduleName="Disponibilidades"
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
      { text: 'Entidad', value: 'entidads_id' },
      { text: 'Potencia Instalada Real', value: 'potInstalada' },
      { text: 'Potencia Disponible Real', value: 'potDisponible' },
      { text: 'Fecha', value: 'created_at' },
      { text: 'Acciones', value: 'marca', sortable: false, align: 'center' }
    ],
    disponibilidades: [],
    options: {
      validateAfterChanged: true,
      validateAfterLoad: true
    },
    schema: {
      fields: [
        {
          type: 'select',
          label: 'Entidad',
          model: 'entidads_id',
          // values: array, //array de  entidades
          selectOptions: {
            noneSelectedText: 'Seleccione una entidad',
            name: 'nombre'
          }
        },
        {
          type: 'input',
          inputType: 'number',
          label: 'Potencia Instalada Real',
          model: 'potInstaladaReal'
        },
        {
          type: 'input',
          inputType: 'number',
          label: 'Potencia Disponible Real',
          model: 'potDisponibleReal'
        }
      ]
    }
  }),

  mounted () {
    if (this.$store.getters.get('disponibilidades').length === 0) {
      this.$store.dispatch('GET', 'disponibilidades').then((result) => {
        this.disponibilidades = this.$store.getters.get('disponibilidades')
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
      this.disponibilidades = this.$store.getters.get('disponibilidades')
    }
  }
}
</script>
