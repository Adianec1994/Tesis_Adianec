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
        <td>{{ centralesElectricasName(props.item.grupo_id) }}</td>
        <td class="text-xs-center justify-center">{{ props.item.grupo_id }}</td>
        <td class="text-xs-center justify-center">{{ props.item.grupo_id }}</td>
        <td class="text-xs-center justify-center">{{ props.item.estado }}</td>
        <td class="text-xs-center justify-center">{{ props.item.fechaEvento }}</td>
        <td class="text-xs-center justify-center">{{ props.item.fechaPosibleSolucion }}</td>
        <td class="text-xs-center justify-center">{{ props.item.fechaReporte }}</td>
        <td class="text-xs-center justify-center">{{ props.item.fechaDiagnostico }}</td>
        <td class="text-xs-center justify-center">{{ props.item.horas }}</td>
        <td class="text-xs-center justify-center">{{ props.item.sistema }}</td>
        <td class="text-xs-center justify-center">{{ props.item.subSistema }}</td>
        <td class="text-xs-center justify-center">{{ props.item.parte }}</td>
        <td class="text-xs-center justify-center">{{ props.item.fallo }}</td>
        <td class="text-xs-center justify-center">{{ props.item.diagnosticoPreliminar }}</td>
        <td class="text-xs-center justify-center">{{ props.item.diagnostico }}</td>
        <td class="text-xs-center justify-center">{{ props.item.responsable }}</td>
        <td class="text-xs-center justify-center">{{ props.item.insertadoPor }}</td>
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
            <v-card-text>{{`¿Seguro que desea eliminar la entrada?`}}</v-card-text>
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
    moduleName: 'Eventos diarios',
    headers: [
      { text: 'Central Eléctrica', value: '' },
      { text: 'Batería', value: '' },
      { text: 'Grupo', value: 'grupo_id' },
      { text: 'Estado', value: 'estado' },
      { text: 'Fecha del evento', value: 'fechaEvento' },
      { text: 'Fecha posible solución', value: 'fechaPosibleSolucion' },
      { text: 'Fecha del reporte', value: 'fechaReporte' },
      { text: 'Fecha del diagnóstico', value: 'fechaDiagnostico' },
      { text: 'Horas', value: 'horas' },
      { text: 'Sistema', value: 'sistema' },
      { text: 'Subsistema', value: 'subSistema' },
      { text: 'Parte', value: 'parte' },
      { text: 'Fallo', value: 'fallo' },
      { text: 'Diagnóstico preliminar', value: 'diagnosticoPreliminar' },
      { text: 'Diagnóstico', value: 'diagnostico' },
      { text: 'Responsable', value: 'responsable' },
      { text: 'Insertado por', value: 'insertadoPor' },
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
          type: 'select',
          label: 'Batería',
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
          label: 'Grupo',
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
          label: 'Estado',
          model: 'estado',
          values: ['Mantenimiento', 'Avería', 'Asimilación'],
          selectOptions: {
            noneSelectedText: 'Seleccione un estado'
          }
        },
        {
          type: 'input',
          inputType: 'date',
          label: 'Fecha del evento',
          model: 'fechaEvento'
        },
        {
          type: 'input',
          inputType: 'date',
          label: 'Fecha posible solución',
          model: 'fechaPosibleSolucion'
        },
        {
          type: 'input',
          inputType: 'date',
          label: 'Fecha del reporte',
          model: 'fechaReporte'
        },
        {
          type: 'input',
          inputType: 'date',
          label: 'Fecha del diagnóstico',
          model: 'fechaDiagnostico'
        },
        {
          type: 'input',
          inputType: 'number',
          label: 'Horas de trabajo',
          model: 'horas'
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Sistema',
          model: 'sistema'
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Subsistema',
          model: 'subSistema'
        },
        {
          type: 'textArea',
          label: 'Parte',
          model: 'parte',
          placeholder: 'Parte diario...',
          rows: 3
        },
        {
          type: 'textArea',
          label: 'Fallo',
          model: 'fallo',
          placeholder: 'Descripción del fallo...',
          rows: 3
        },
        {
          type: 'textArea',
          label: 'Diagnóstico preliminar',
          model: 'diagnosticoPreliminar',
          rows: 3
        },
        {
          type: 'textArea',
          label: 'Diagnóstico',
          model: 'diagnostico',
          rows: 3
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Responsable',
          model: 'responsable'
        },
        {
          type: 'input',
          inputType: 'number',
          label: 'Índice de consumo',
          model: 'indiceConsumo'
        },
        {
          type: 'label',
          label: 'Insertado por',
          model: 'insertadoPor'
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
