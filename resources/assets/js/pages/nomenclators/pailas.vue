<template>
  <div>
    <v-toolbar flat color="white">
      <v-toolbar-title>{{moduleName}}</v-toolbar-title>
      <v-divider class="mx-2" inset vertical></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <template v-slot:activator="{ on }">
          <v-btn color="primary" dark class="mb-2" v-on="on" v-on:click="isNewModel=true">Nuevo</v-btn>
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
                ></vue-form-generator>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" dark @click="saveItem">Guardar</v-btn>
            <v-btn color="blue darken-1" flat @click="close">Cancelar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="items"
      :rows-per-page-text="'Filas por páginas'"
      :rows-per-page-items="pageitems"
      class="elevation-1"
    >
      <template v-slot:items="props">
        <td>{{ centralesElectricasName(props.item.central_electricas_id) }}</td>
        <td>{{ props.item.created_at }}</td>
        <td class="text-xs-center justify-center">{{ operadoresName(props.item.operadors_id) }}</td>
        <td class="text-xs-center justify-center">{{ operadoresName(props.item.chofer_id) }}</td>
        <td class="text-xs-center justify-center">{{ operadoresName(props.item.acompanante_id) }}</td>
        <td class="text-xs-center justify-center">{{ props.item.combustibleFactura }}</td>
        <td class="text-xs-center justify-center">{{ props.item.combustibleMedicion }}</td>
        <td class="text-xs-center justify-center">{{ props.item.acciones }}</td>
        <td class="text-xs-center justify-center">
          <v-tooltip bottom>
            <v-icon small color="orange lighten-2" class="mr-2" @click="editItem(props.item)" slot="activator">
              edit
            </v-icon>
            <span>Editar</span>
          </v-tooltip>
          <v-tooltip bottom>
            <v-icon small color="red lighten-2" @click="$set(deleteDialog,props.item.id,true)" slot="activator">
              delete
            </v-icon>
            <span>Eliminar</span>
          </v-tooltip>
        </td>
        <v-dialog
          v-model="deleteDialog[props.item.id]"
          :key="props.item.id"
          persistent
          max-width="290"
        >
          <v-card>
            <v-card-title>
              <b>Eliminar</b>
            </v-card-title>
            <v-card-text>{{`¿Seguro que desea eliminar la paila?`}}</v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="primary" dark @click.stop="deleteItem(props.item)">Eliminar</v-btn>
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
    moduleName: 'Pailas',
    headers: [
      { text: 'Central Eléctrica', value: 'central_electricas_id' },
      { text: 'Fecha/Hora', value: 'created_at' },
      { text: 'Operador', value: 'operadors_id' },
      { text: 'Chofer', value: 'chofer_id' },
      { text: 'Acompañante', value: 'acompanante_id' },
      { text: 'Factura de combustible', value: 'combustibleFactura', align: 'center' },
      { text: 'Medición de combustible', value: 'combustibleMedicion', align: 'center' },
      { text: 'Acciones realizadas', value: 'acciones', align: 'center' },
      { text: 'Acciones', sortable: false, align: 'center' }
    ],
    pageitems: [
      5, 10, 30,
      { text: 'Todo', value: -1 }
    ],
    items: [],
    entidades: [],
    operadores: [],
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
          type: 'select',
          label: 'Operador',
          model: 'operadors_id',
          values: [],
          selectOptions: {
            noneSelectedText: 'Seleccione un operador',
            name: 'nombre',
            value: 'id'
          }
        },
        {
          type: 'select',
          label: 'Chofer',
          model: 'chofer_id',
          values: [],
          selectOptions: {
            noneSelectedText: 'Seleccione un chofer',
            name: 'nombre',
            value: 'id'
          }
        },
        {
          type: 'select',
          label: 'Acompañante',
          model: 'acompanante_id',
          values: [],
          selectOptions: {
            noneSelectedText: 'Seleccione un acompañante',
            name: 'nombre',
            value: 'id'
          }
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Factura de combustible',
          model: 'combustibleFactura',
          validator: ['double'],
          max: 3
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Medición de combustible',
          model: 'combustibleMedicion',
          validator: ['double'],
          max: 3
        },
        {
          type: 'textArea',
          label: 'Acciones',
          model: 'acciones',
          placeholder: 'Detalle brevemente las acciones realizadas...',
          rows: 3
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
    },
    operadors () {
      return this.operadores.filter(o => o.ocupacion === 'Operador')
    },
    choferes () {
      return this.operadores.filter(o => o.ocupacion === 'Chofer')
    },
    acompanantes () {
      return this.operadores.filter(o => o.ocupacion === 'Acompañante')
    }

  },

  watch: {
    dialog (val) {
      val || this.close()
    }
  },

  mounted () {
    const promises = []

    promises.push(this.$store.dispatch('GET', 'centrales_electricas').then((result) => {
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
    )

    promises.push(this.$store.dispatch('GET', 'operadores').then((result) => {
      this.operadores = this.$store.getters.get('operadores')
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
    )

    promises.push(this.$store.dispatch('GET', this.lowerModuleName).then((result) => {
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
    )

    Promise.all(promises).then(values => {
      var field = this.$data.schema.fields.find(field => field.model === 'central_electricas_id')
      field.values = this.centrales_electricas

      var operadoresField = this.$data.schema.fields.find(field => field.model === 'operadors_id')
      operadoresField.values = this.operadors

      var choferesField = this.$data.schema.fields.find(field => field.model === 'chofer_id')
      choferesField.values = this.choferes

      var acompanantesField = this.$data.schema.fields.find(field => field.model === 'acompanante_id')
      acompanantesField.values = this.acompanantes
    })
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
    },

    operadoresName (id) {
      const operador = this.operadores.find(o => o.id === id)
      return operador.nombre
    }
  }
}
</script>
