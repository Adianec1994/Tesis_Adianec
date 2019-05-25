<template>
  <div>
    <v-toolbar
      flat
      color="white"
    >
      <v-toolbar-title>{{moduleName}}</v-toolbar-title>
      <v-divider
        class="mx-2"
        inset
        vertical
      ></v-divider>
      <v-spacer></v-spacer>
      <v-dialog
        v-model="dialog"
        max-width="500px"
      >
        <template v-slot:activator="{ on }">
          <v-btn
            color="primary"
            dark
            class="mb-2"
            v-on="on"
            v-on:click="isNewModel=true"
          >Nuevo</v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <vue-form-generator
                  :schema="schema"
                  :model="editedItem"
                  :options="options"
                  :isNewModel="isNewModel"
                  @model-updated="updateItem"
                  @validated="formIsValid"
                >
                </vue-form-generator>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="primary"
              dark
              @click="saveItem"
            >Guardar</v-btn>
            <v-btn
              color="blue darken-1"
              flat
              @click="close"
            >Cancelar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="items"
      class="elevation-1"
    >
      <template v-slot:items="props">
        <td>{{ centralesElectricasName(props.item.central_electricas_id) }}</td>
        <td class="text-xs-center justify-center">{{ props.item.planReserva }}</td>
        <td class="text-xs-center justify-center">{{ props.item.fondaje }}</td>
        <td class="text-xs-center justify-center">{{ props.item.existOperativa }}</td>
        <td class="text-xs-center justify-center">{{ props.item.coberturaHoras }}</td>
        <td class="text-xs-center justify-center">{{ props.item.consumo }}</td>
        <td class="text-xs-center justify-center">{{ props.item.suminCupet }}</td>
        <td class="text-xs-center justify-center">{{ props.item.capacTotalAlmac }}</td>
        <td class="text-xs-center justify-center">{{ props.item.capacVacio }}</td>
        <td class="text-xs-center justify-center">{{ props.item.existTotalDiaAnterior }}</td>
        <td class="text-xs-center justify-center">
          <v-icon
            small
            class="mr-2"
            @click="editItem(props.item)"
          >
            edit
          </v-icon>
          <v-icon
            small
            @click="$set(deleteDialog,props.item.id,true)"
          >
            delete
          </v-icon>
        </td>
        <v-dialog
          v-model="deleteDialog[props.item.id]"
          :key="props.item.id"
          persistent
          max-width="290"
        >
          <v-card>
            <v-card-title><b>Eliminar</b></v-card-title>
            <v-card-text>{{'¿Seguro que desea eliminar el hecho extraordinario?'}}</v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="primary"
                dark
                @click.stop="deleteItem(props.item)"
              >Eliminar</v-btn>
              <v-btn
                color="blue darken-1"
                flat
                @click.stop="$set(deleteDialog,props.item.id,false)"
              >Cancelar</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </template>
      <template v-slot:no-data>
        <h4>Sin datos para mostrar</h4>
      </template>
    </v-data-table>
  </div>
</template>

<script>

export default {
  data: () => ({
    dialog: false,
    deleteDialog: {},
    editedItem: {},
    editedIndex: -1,
    isNewModel: false,
    moduleName: 'Coberturas combustibles',
    headers: [
      { text: 'Central Eléctrica', value: 'central_electricas_id' },
      { text: 'Plan de reserva', value: 'planReserva', align: 'center' },
      { text: 'Fondaje', value: 'fondaje', align: 'center' },
      { text: 'Existencia operativa', value: 'existOperativa', align: 'center' },
      { text: 'Cobertura x horas', value: 'coberturaHoras', align: 'center' },
      { text: 'Consumo', value: 'consumo', align: 'center' },
      { text: 'Suministro CUPET', value: 'suminCupet', align: 'center' },
      { text: 'Cap. Total Almacenda', value: 'capacTotalAlmac', align: 'center' },
      { text: 'Capacidad vacío', value: 'capacVacio', align: 'center' },
      { text: 'Existencia día anterior', value: 'existTotalDiaAnterior', align: 'center' },
      { text: 'Acciones', sortable: false, align: 'center' }
    ],
    items: [],
    entidades: [],
    options: {
      validateAfterChanged: true,
      validateAfterLoad: true
    },
    schema: {
      fields: [
        {
          type: 'select',
          label: 'Central Eléctrica',
          model: 'central_electricas_id',
          values: [],
          selectOptions: {
            noneSelectedText: 'Seleccione una central eléctrica',
            name: 'nombre',
            value: 'id'
          }
        },
        {
          type: 'input',
          inputType: 'number',
          label: 'Plan de reserva',
          model: 'planReserva'
        },
        {
          type: 'input',
          inputType: 'number',
          label: 'Fondaje',
          model: 'fondaje'
        },
        {
          type: 'input',
          inputType: 'number',
          label: 'Existencia operativa',
          model: 'existOperativa'
        },
        {
          type: 'input',
          inputType: 'number',
          label: 'Cobertura x horas',
          model: 'coberturaHoras'
        },
        {
          type: 'input',
          inputType: 'number',
          label: 'Consumo',
          model: 'consumo'
        },
        {
          type: 'input',
          inputType: 'number',
          label: 'Suministro CUPET',
          model: 'suminCupet'
        },
        {
          type: 'input',
          inputType: 'number',
          label: 'Cap. Total Almacenda',
          model: 'capacTotalAlmac'
        },
        {
          type: 'input',
          inputType: 'number',
          label: 'Capacidad vacío',
          model: 'capacVacio'
        },
        {
          type: 'input',
          inputType: 'number',
          label: 'Existencia día anterior',
          model: 'existTotalDiaAnterior'
        }
      ]
    }
  }),

  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'Nuevo' : 'Editar'
    },
    lowerModuleName () {
      return this.moduleName.split(' ').join('_').toLowerCase()
    }

  },

  watch: {
    dialog (val) {
      val || this.close()
    }
  },

  mounted () {
    this.centrales_electricas = this.$store.getters.get('centrales_electricas')
    this.items = this.$store.getters.get(this.lowerModuleName)

    if (this.centrales_electricas.length === 0) {
      this.$store.dispatch('GET', 'centrales_electricas').then((result) => {
        this.centrales_electricas = this.$store.getters.get('centrales_electricas')
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
    }

    if (this.items.length === 0) {
      this.$store.dispatch('GET', this.lowerModuleName).then((result) => {
        this.items = this.$store.getters.get(this.lowerModuleName)
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
    }

    var field = this.$data.schema.fields.find(field => field.model === 'central_electricas_id')
    field.values = this.centrales_electricas
  },

  methods: {
    editItem (item) {
      this.editedIndex = this.items.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    updateItem (newVal, property) {
      // this.formIsValid()
      this.editedItem[property] = newVal
    },

    saveItem () {
      let response
      if (this.editedIndex === -1) {
        response = this.$store.dispatch('SAVE', { payload: this.editedItem, moduleName: this.lowerModuleName })
      } else {
        response = this.$store.dispatch('EDIT', { payload: this.editedItem, moduleName: this.lowerModuleName })
      }

      response.then(result => {
        this.$store.dispatch('responseMessage', {
          type: result.success ? 'success' : 'error',
          text: result.message
        })
        this.close()
      })
    },

    formIsValid (isValid, errors) {
      // return isValid
      // console.log('Results ', isValid, ', Errors ', errors)
    },

    deleteItem (item) {
      this.$store.dispatch('DESTROY', { payload: item, moduleName: this.lowerModuleName }).then((result) => {
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
    },

    close () {
      this.dialog = false
      this.isNewModel = false
      setTimeout(() => {
        this.editedItem = Object.assign({}, {})
        this.editedIndex = -1
      }, 300)
    },

    centralesElectricasName (id) {
      const centralElectrica = this.centrales_electricas.find(ce => ce.id === id)
      return centralElectrica.nombre
    }
  }
}
</script>
