<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
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
      :rows-per-page-text="'Filas por páginas'"
      :rows-per-page-items="pageitems"
      class="elevation-1"
    >
      <template v-slot:items="props">
        <td>{{ entidadName(props.item.entidads_id) }}</td>
        <td class="text-xs-center justify-center">{{ props.item.anno }}</td>
        <td class="text-xs-center justify-center">{{ props.item.mes }}</td>
        <td class="text-xs-center justify-center">{{ props.item.generacion }}</td>
        <td class="text-xs-center justify-center">{{ props.item.indiceConsumoCombustible }}</td>
        <td class="text-xs-center justify-center">{{ props.item.compromiso }}</td>
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
            <v-card-text>{{'¿Seguro que desea eliminar el plan?'}}</v-card-text>
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
    moduleName: 'Planes',
    headers: [
      { text: 'Entidad', value: 'entidads_id' },
      { text: 'Año', value: 'anno', align: 'center' },
      { text: 'Mes', value: 'mes', align: 'center' },
      { text: 'Generación', value: 'generacion', align: 'center' },
      { text: 'Índice de consumo de combustible', value: 'indiceConsumoCombustible', align: 'center' },
      { text: 'Compromiso', value: 'compromiso', align: 'center' },
      { text: 'Acciones', sortable: false, align: 'center' }
    ],
    pageitems: [
      5,10,30,
      { text: "Todo", value: -1}
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
          label: 'Entidad',
          model: 'entidads_id',
          values: [], // array de  entidades
          selectOptions: {
            noneSelectedText: 'Seleccione una entidad',
            name: 'nombre',
            value: 'id'
          }
        },
        /*{
          type: 'dateTimePicker',
          label: 'Año',
          model: 'anno',
          dateTimePickerOptions: {
            format: 'MM/YYYY',
            viewMode(months){}
          },
        },*/
        {
          type: 'input',
          inputType: 'text',
          label: 'Año',
          model: 'anno',
          validator: ['integer'],
          max: 2100
        },
        {
          type: 'select',
          label: 'Mes',
          model: 'mes',
          values: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          selectOptions: {
            noneSelectedText: 'Seleccione un mes'
          }
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Generación',
          model: 'generacion',
          validator: ['double'],
          max: 3
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Índice de consumo de combustible',
          model: 'indiceConsumoCombustible',
          validator: ['double'],
          max: 3
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Compromiso',
          model: 'compromiso',
          validator: ['double'],
          max: 3
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

    promises.push(this.$store.dispatch('GET', 'entidades').then((result) => {
      this.entidades = this.$store.getters.get('entidades')
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
      var field = this.$data.schema.fields.find(field => field.model === 'entidads_id')
      field.values = this.entidades
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

    formatDate (date) {
      if (date) {
        return new Date(date).toLocaleDateString()
        // return date.split(' ')[0]
      }
    },

    entidadName (id) {
      const entidad = this.entidades.find(e => e.id === id)
      return entidad.nombre
    }
  }
}
</script>
