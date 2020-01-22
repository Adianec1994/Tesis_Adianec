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
      <v-text-field
        v-model="search"
        append-icon="search"
        label="Filtrar"
        single-line
        hide-details
      ></v-text-field>
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
      :search="search"
      :rows-per-page-text="'Filas por páginas'"
      :rows-per-page-items="pageitems"
      class="elevation-1"
    >
      <template v-slot:items="props">
        <td>{{ centralesElectricasName(props.item.grupos_id) }}</td>
        <td class="text-xs-center justify-center">{{ bateriasName(props.item.grupos_id) }}</td>
        <td class="text-xs-center justify-center">{{ gruposName(props.item.grupos_id) }}</td>
        <td class="text-xs-center justify-center">{{ props.item.estado }}</td>
        <td class="text-xs-center justify-center">{{ formatDate(props.item.fechaEvento) }}</td>
        <td class="text-xs-center justify-center">{{ formatDate(props.item.fechaPosibleSolucion) }}</td>
        <td class="text-xs-center justify-center">{{ formatDate(props.item.fechaReporte) }}</td>
        <td class="text-xs-center justify-center">{{ formatDate(props.item.fechaDiagnostico) }}</td>
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
      <template v-slot:no-results>
        <h4>Su búsqueda por "{{ search }}" no encontró resultados</h4>
      </template>
    </v-data-table>
  </div>
</template>

<script>

export default {
  data: () => ({
    search: '',
    dialog: false,
    deleteDialog: {},
    editedItem: {},
    editedIndex: -1,
    isNewModel: false,
    moduleName: 'Eventos diarios',
    headers: [
      { text: 'Central Eléctrica', value: '' },
      { text: 'Batería', value: '', align: 'center' },
      { text: 'Grupo', value: 'grupo_id', align: 'center' },
      { text: 'Estado', value: 'estado', align: 'center' },
      { text: 'Fecha del evento', value: 'fechaEvento', align: 'center' },
      { text: 'Fecha posible solución', value: 'fechaPosibleSolucion', align: 'center' },
      { text: 'Fecha del reporte', value: 'fechaReporte', align: 'center' },
      { text: 'Fecha del diagnóstico', value: 'fechaDiagnostico', align: 'center' },
      { text: 'Horas', value: 'horas', align: 'center' },
      { text: 'Sistema', value: 'sistema', align: 'center' },
      { text: 'Subsistema', value: 'subSistema', align: 'center' },
      { text: 'Parte', value: 'parte', align: 'center' },
      { text: 'Fallo', value: 'fallo', align: 'center' },
      { text: 'Diagnóstico preliminar', value: 'diagnosticoPreliminar', align: 'center' },
      { text: 'Diagnóstico', value: 'diagnostico', align: 'center' },
      { text: 'Responsable', value: 'responsable', align: 'center' },
      { text: 'Insertado por', value: 'insertadoPor', align: 'center' },
      { text: 'Acciones', sortable: false, align: 'center' }
    ],
    pageitems: [
      5,10,30,
      { text: "Todo", value: -1}
    ],
    items: [],
    centralesElectricas: [],
    baterias: [],
    grupos: [],
    options: {
      validateAfterChanged: true,
      validateAfterLoad: false,
      validateAsync: true
    },
    schema: {
      fields: [
        {
          type: 'select',
          label: 'Central Eléctrica',
          model: 'central_electricas_id',
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
          label: 'Grupo',
          model: 'grupos_id',
          id: 'grupos',
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
          label: 'Estado',
          model: 'estado',
          values: ['Mantenimiento', 'Avería', 'Asimilación', 'Disponible'],
          selectOptions: {
            hideNoneSelectedText: true
          }
        },
        {
          type: 'input',
          inputType: 'date',
          label: 'Fecha del evento',
          model: 'fechaEvento',
          format: 'YYYY-MM-DD',
          visible: function () {
            return this.isNewModel
          }
        },
        {
          type: 'label',
          label: 'Fecha del evento',
          model: 'fechaEvento',
          visible: function () {
            return !this.isNewModel
          },
          get: function (model) {
            return new Date(model.fechaEvento).toLocaleDateString()
          }
        },
        {
          type: 'input',
          inputType: 'date',
          label: 'Fecha posible solución',
          model: 'fechaPosibleSolucion',
          format: 'YYYY-MM-DD'
        },
        {
          type: 'input',
          inputType: 'date',
          label: 'Fecha del reporte',
          model: 'fechaReporte',
          format: 'YYYY-MM-DD'
        },
        {
          type: 'input',
          inputType: 'date',
          label: 'Fecha del diagnóstico',
          model: 'fechaDiagnostico',
          format: 'YYYY-MM-DD'
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Horas de trabajo',
          model: 'horas',
          validator: ['integer'],
          max: 20000
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Sistema',
          model: 'sistema',
          validator: ['nombre']
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Subsistema',
          model: 'subSistema',
          validator: ['nombre']
        },
        {
          type: 'textArea',
          label: 'Parte',
          model: 'parte',
          placeholder: 'Parte con problema...',
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
          model: 'responsable',
          validator: ['nombre']
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Insertado por',
          model: 'insertadoPor',
          validator: ['nombre']
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

    promises.push(this.$store.dispatch('GET', 'grupos').then((result) => {
      this.grupos = this.$store.getters.get('grupos')
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
      field.values = this.centralesElectricas
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
      if (property === 'central_electricas_id') {
        return this.listadoBaterias(newVal)
      } else
        if (property === 'baterias_id') {
          return this.listadoGrupos(newVal)
        }
      this.editedItem[property] = newVal
    },

    saveItem () {
      let response
      this.editedItem.insertadoPor = this.$store.getters.authUser.name
      if (this.editedIndex === -1) {
        response = this.$store.dispatch('SAVE', { payload: this.editedItem, moduleName: this.lowerModuleName })
      } else {
        response = this.$store.dispatch('EDIT', { payload: this.editedItem, moduleName: this.lowerModuleName })
      }

      this.cleanSelectBaterias()
      this.cleanSelectGrupos()

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
      this.cleanSelectBaterias()
      this.cleanSelectGrupos()
    },

    gruposName (id) {
      const grupo = this.grupos.find(g => g.id === id)
      return grupo.numero
    },

    bateriasName (id) {
      const grupos = this.grupos.find(g => g.id === id)
      const bateria = this.baterias.find(b => b.id === grupos.baterias_id)
      return bateria.numero
    },

    centralesElectricasName (id) {
      const grupos = this.grupos.find(g => g.id === id)
      const bateria = this.baterias.find(b => b.id === grupos.baterias_id)
      const centralElectrica = this.centralesElectricas.find(ce => ce.id === bateria.central_electricas_id)
      return centralElectrica.nombre
    },

    formatDate (date) {
      if (date) {
        return new Date(date).toLocaleDateString()
        // return date.split(' ')[0]
      }
    },

    cleanSelectBaterias () {
      const select = document.getElementById('baterias')
      select ? select.options.length = 0 : ''
    },

    cleanSelectGrupos () {
      const select = document.getElementById('grupos')
      select ? select.options.length = 0 : ''
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

    listadoGrupos (idBateria) {
      this.cleanSelectGrupos()

      const selectGrupos = document.getElementById('grupos')

      let bateria = this.baterias.find(b => b.id == idBateria) // idBateria es un string

      bateria = this.centralesElectricas.find(ce => ce.id === bateria.central_electricas_id).baterias.find(b => b.id === bateria.id)

      bateria.grupos.forEach(b => {
        const opt = document.createElement('option')
        // opt.setAttribute('name', 'bateriaOpt')
        opt.text = b.numero
        opt.value = b.id
        selectGrupos.appendChild(opt)
      })
    }
  }
}
</script>
