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
        max-width="450px"
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
        <!--<td>{{ centralesElectricasName(props.item.grupos_id) }}</td>
        <td class="text-xs-center justify-center">{{ bateriasName(props.item.grupos_id) }}</td>-->
        <td class="text-xs-center justify-center">{{ gruposName(props.item.grupos_id) }}</td>
        <td class="text-xs-center justify-center">{{ formatDate(props.item.fechaMtto) }}</td>
        <td class="text-xs-center justify-center">{{ props.item.tipoTrabajo }}</td>
        <td class="text-xs-center justify-center">{{ props.item.horaEntrada }}</td>
        <td class="text-xs-center justify-center">{{ props.item.horaSalida }}</td>
        <td class="text-xs-center justify-center">{{ props.item.informa }}</td>
        <td class="text-xs-center justify-center">{{ props.item.resultado }}</td>
        <td class="text-xs-center justify-center">{{ brigadasName(props.item.brigadas_id) }}</td>
        <td class="text-xs-center justify-center">{{ mantenedoresName(props.item.mantenedores_externos_id) }}</td>
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
      moduleName: 'Mantenimientos',
      headers: [
        /*{ text: 'Central Eléctrica', value: '' },
        { text: 'Batería', value: '', align: 'center' },*/
        { text: 'Grupo', value: 'grupos_id', align: 'center' },
        { text: 'Brigada', value: 'brigadas_id', align: 'center' },
        { text: 'Mantenedor Externo', value: 'mantenedores_externos_id', align: 'center' },
        { text: 'Fecha de Mantenimiento', value: 'fechaMtto', align: 'center' },
        { text: 'Tipo de Trabajo', value: 'tipoTrabajo', align: 'center' },
        { text: 'Hora de entrada', value: 'horaEntrada', align: 'center' },
        { text: 'Hora de salida', value: 'horaSalida', align: 'center' },
        { text: 'Informa', value: 'informa', align: 'center' },
        { text: 'Resultado', value: 'resultado', align: 'center' },
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
      brigadas: [],
      mantenedores_externos: [],
      options: {
        validateAfterChanged: true,
        validateAfterLoad: true
      },
      schema: {
        fields: [
          /*{
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
          },*/
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
            label: 'Brigada',
            model: 'brigadas_id',
            id: 'brigadas',
            values: [],
            selectOptions: {
              noneSelectedText: 'Seleccione una brigada',
              name: 'numero',
              value: 'id'
            },
            visible: function () {
              return this.isNewModel
            }
          },
          {
            type: 'select',
            label: 'Mantenedor Externo',
            model: 'mantenedores_externos_id',
            id: 'mantenedores_externos',
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
            type: 'input',
            inputType: 'date',
            label: 'Fecha',
            model: 'fechaMtto',
            format: 'YYYY-MM-DD',
            visible: function () {
              return this.isNewModel
            }
          },
          {
            type: 'input',
            inputType: 'text',
            label: 'Tipo de trabajo',
            model: 'tipoTrabajo',
            validator: ['nombre']
          },
          {
            type: 'input',
            inputType: 'time',
            label: 'Hora de entrada',
            model: 'horaEntrada',
            format: 'HH:MM AM/PM'
          },
          {
            type: 'input',
            inputType: 'time',
            label: 'Hora de salida',
            model: 'horaSalida',
            format: 'HH:MM AM/PM'
          },
          {
            type: 'input',
            inputType: 'text',
            label: 'Informa',
            model: 'informa',
            validator: ['nombre']
          },
          {
            type: 'input',
            inputType: 'text',
            label: 'Resultado',
            model: 'resultado',
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

      promises.push(this.$store.dispatch('GET', 'brigadas').then((result) => {
          this.brigadas = this.$store.getters.get('brigadas')
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

      promises.push(this.$store.dispatch('GET', 'mantenedores_externos').then((result) => {
          this.mantenedores_externos = this.$store.getters.get('mantenedores_externos')
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
        var field = this.$data.schema.fields.find(field => field.model === 'brigadas_id')
        field.values = this.brigadas
      })

      Promise.all(promises).then(values => {
        var field = this.$data.schema.fields.find(field => field.model === 'mantenedores_externos_id')
        field.values = this.mantenedores_externos
      })

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

      brigadasName (id) {
        const brigada = this.brigadas.find(g => g.id === id)
        return brigada.numero
      },

      mantenedoresName (id) {
        const mantenedor = this.mantenedores_externos.find(g => g.id === id)
        return mantenedor.nombre
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

