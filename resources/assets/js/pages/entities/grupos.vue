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
        <td>{{ centralElectricaName(props.item.baterias_id) }}</td>
        <td>{{ bateriasName(props.item.baterias_id) }}</td>
        <td>{{ proveedoresName(props.item.proveedors_id) }}</td>
        <td class="text-xs-center justify-center">{{ props.item.numero }}</td>
        <td class="text-xs-center justify-center">{{ props.item.potInstalada }}</td>
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
            <v-card-text>{{`¿Seguro que desea eliminar el grupo ${props.item.numero}?`}}</v-card-text>
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
    moduleName: 'Grupos',
    headers: [
      { text: 'Central Eléctrica' },
      { text: 'Batería', value: 'baterias_id' },
      { text: 'Proveedor', value: 'proveedors_id' },
      { text: 'Número', value: 'numero', align: 'center' },
      { text: 'Potencia instalada', value: 'potInstalada', align: 'center' },
      { text: 'Acciones', sortable: false, align: 'center' }
    ],
    items: [],
    baterias: [],
    proveedores: [],
    options: {
      validateAfterChanged: true,
      validateAfterLoad: true
    },
    schema: {
      fields: [
        {
          type: 'select',
          label: 'Batería',
          model: 'baterias_id',
          values: [],
          selectOptions: {
            noneSelectedText: 'Seleccione una batería',
            name: 'numero',
            value: 'id'
          }
        },
        {
          type: 'select',
          label: 'Proveedor',
          model: 'proveedors_id',
          values: [],
          selectOptions: {
            noneSelectedText: 'Seleccione un proveedor',
            name: 'marca',
            value: 'id'
          }
        },
        {
          type: 'input',
          inputType: 'number',
          label: 'Número',
          model: 'numero'
        },
        {
          type: 'input',
          inputType: 'number',
          label: 'Potencia instalada',
          model: 'potInstalada'
        }
      ]
    }
  }),

  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'Nuevo' : 'Editar'
    },
    lowerModuleName () {
      return this.moduleName.toLowerCase()
    }

  },

  watch: {
    dialog (val) {
      val || this.close()
    }
  },

  mounted () {
    this.baterias = this.$store.getters.get('baterias')
    this.proveedores = this.$store.getters.get('proveedores')
    this.items = this.$store.getters.get(this.lowerModuleName)

    if (this.baterias.length === 0) {
      this.$store.dispatch('GET', 'baterias').then((result) => {
        this.centrales_electricas = this.$store.getters.get('baterias')
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

    if (this.proveedores.length === 0) {
      this.$store.dispatch('GET', 'proveedores').then((result) => {
        this.centrales_electricas = this.$store.getters.get('proveedores')
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

    var bateriasField = this.$data.schema.fields.find(field => field.model === 'baterias_id')
    bateriasField.values = this.baterias

    var proveedoresField = this.$data.schema.fields.find(field => field.model === 'proveedors_id')
    proveedoresField.values = this.proveedores
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

    bateriasName (id) {
      const bateria = this.baterias.find(b => b.id === id)
      return bateria.numero
    },

    centralElectricaName (id) {
      const bateria = this.baterias.find(b => b.id === id)
      const centralElectrica = this.$store.getters.get('centrales_electricas').find(ce => ce.id === bateria.central_electricas_id)
      return centralElectrica.nombre
    },

    proveedoresName (id) {
      const proveedor = this.proveedores.find(p => p.id === id)
      return proveedor.marca
    }
  }
}
</script>
