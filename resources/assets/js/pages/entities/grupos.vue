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
        max-width="400px"
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
      :rows-per-page-text="'Filas por páginas'"
      :rows-per-page-items="pageitems"
      class="elevation-1"
    >
      <template v-slot:items="props">
        <td>{{ centralElectricaName(props.item.baterias_id) }}</td>
        <td class="text-xs-center justify-center">{{ bateriasName(props.item.baterias_id) }}</td>
        <td class="text-xs-center justify-center">{{ proveedoresName(props.item.proveedors_id) }}</td>
        <td class="text-xs-center justify-center">{{ props.item.numero }}</td>
        <td class="text-xs-center justify-center">{{ props.item.potInstalada }}</td>
        <td class="text-xs-center justify-center">
          <v-tooltip bottom>
            <v-icon
              small
              class="mr-2"
              @click="editItem(props.item)"
              slot="activator"
            >
              edit
            </v-icon>
            <span>Editar</span>
          </v-tooltip>
          <v-tooltip bottom>
            <v-icon
              small
              @click="$set(deleteDialog,props.item.id,true)"
              slot="activator"
            >
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
      { text: 'Batería', value: 'baterias_id', align: 'center' },
      { text: 'Proveedor', value: 'proveedors_id', align: 'center' },
      { text: 'Número de Grupo', value: 'numero', align: 'center' },
      { text: 'Potencia instalada', value: 'potInstalada', align: 'center' },
      { text: 'Acciones', sortable: false, align: 'center' }
    ],
    pageitems: [
      5,10,30,
      { text: "Todo", value: -1}
    ],
    items: [],
    centralesElectricas: [],
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
          label: 'Central Eléctrica',
          model: 'central_electrica_id',
          id: 'central',
          values: [],
          selectOptions: {
            hideNoneSelectedText: true,
            name: 'nombre',
            value: 'id'
          },
          visible: function () {
            return this.isNewModel
          }
        },
        {
          type: 'select',
          label: 'Batería',
          model: 'baterias_id',
          id: 'baterias',
          values: [],
          selectOptions: {
            hideNoneSelectedText: true,
            name: 'numero',
            value: 'id'
          },
          visible: function () {
            return this.isNewModel
          }
        },
        {
          type: 'select',
          label: 'Proveedor',
          model: 'proveedors_id',
          values: [],
          selectOptions: {
            hideNoneSelectedText: true,
            name: 'nombre',
            value: 'id'
          }
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Número de Grupo',
          model: 'numero',
          validator: ['integer'],
          max: 16
        },
        {
          type: 'select',
          label: 'Potencia instalada',
          model: 'potInstalada',
          values: [
            { name: '0.34', id: '0.34' },
            { name: '0.775', id: '0.775' },
            { name: '0.92', id: '0.92' },
            { name: '1.8704', id: '1.8704'},
            { name: '1.888', id: '1.888'},
            { name: '2.1', id: '2.1'},
            { name: '20', id: '20'}
          ],
          selectOptions: {
            noneSelectedText: 'Seleccione la potencia instalada'
          }
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
    const promises = []

    promises.push(this.$store.dispatch('GET', 'centrales_electricas').then((result) => {
      this.centralesElectricas = this.$store.getters.get('centrales_electricas')
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

    promises.push(this.$store.dispatch('GET', 'baterias').then((result) => {
      this.baterias = this.$store.getters.get('baterias')
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

    promises.push(this.$store.dispatch('GET', 'proveedores').then((result) => {
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
      var centralesField = this.$data.schema.fields.find(field => field.model === 'central_electrica_id')
      centralesField.values = this.centralesElectricas

      var proveedoresField = this.$data.schema.fields.find(field => field.model === 'proveedors_id')
      proveedoresField.values = this.proveedores
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
      if (property === 'central_electrica_id') {
        return this.listadoBaterias(newVal)
      }
      this.editedItem[property] = newVal
    },

    saveItem () {
      let response
      if (this.editedIndex === -1) {
        response = this.$store.dispatch('SAVE', { payload: this.editedItem, moduleName: this.lowerModuleName })
      } else {
        response = this.$store.dispatch('EDIT', { payload: this.editedItem, moduleName: this.lowerModuleName })
      }

      this.updateCentrales()
      this.cleanSelectBaterias()

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
        this.updateCentrales()
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
      this.cleanSelectBaterias()
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
      return proveedor.nombre
    },

    updateCentrales () {
      this.$store.dispatch('GET', 'centrales_electricas').then((result) => {
        this.centralesElectricas = this.$store.getters.get('centrales_electricas')
      })
    },

    listadoBaterias (idCentral) {
      this.cleanSelectBaterias()

      const selectBaterias = document.getElementById('baterias')

      const central = this.centralesElectricas.find(ce => ce.id === idCentral)

      central.baterias.forEach(b => {
        const opt = document.createElement('option')
        // opt.setAttribute('name', 'bateriaOpt')
        opt.text = b.numero
        opt.value = b.id
        selectBaterias.appendChild(opt)
      })
    },

    cleanSelectBaterias () {
      const selectBaterias = document.getElementById('baterias')
      selectBaterias ? selectBaterias.options.length = 0 : ''

      // const opt = document.createElement('option')
      // opt.text = 'Seleccione una batería'
      // selectBaterias.appendChild(opt)
      // selectBaterias.selectedIndex = '1'
    }
  }
}
</script>
