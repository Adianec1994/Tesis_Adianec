<template>
  <div>
    <v-toolbar flat color="white">
      <v-toolbar-title>{{moduleName}}</v-toolbar-title>
      <v-divider class="mx-2" inset vertical></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="450px">
        <template v-slot:activator="{ on }">
          <v-btn
            color="primary"
            dark
            class="mb-2"
            v-on="on"
            v-on:click="isNewModel=true"
            v-if="allowed('cobertura_combustible','create')"
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
        <td class="text-xs-center justify-center">{{ formatDate(props.item.fechaCobertura) }}</td>
        <td class="text-xs-center justify-center">{{ props.item.hora }}</td>
        <td class="text-xs-center justify-center">{{ props.item.capacTotalAlmac }}</td>
        <td class="text-xs-center justify-center">{{ props.item.existTotalDiaAnterior }}</td>
        <td class="text-xs-center justify-center">{{ props.item.existTotal }}</td>
        <td class="text-xs-center justify-center">{{ props.item.capacVacio }}</td>
        <td class="text-xs-center justify-center">{{ props.item.planReserva }}</td>
        <td class="text-xs-center justify-center">{{ props.item.fondaje }}</td>
        <td class="text-xs-center justify-center">{{ props.item.existOperativa }}</td>
        <td class="text-xs-center justify-center">{{ props.item.coberturaHoras }}</td>
        <td class="text-xs-center justify-center">{{ props.item.consumo }}</td>
        <td class="text-xs-center justify-center">{{ props.item.suminCupet }}</td>

        <td class="text-xs-center justify-center">
          <v-tooltip bottom v-if="allowed('cobertura_combustible','update')">
            <v-icon
              small
              color="orange lighten-2"
              class="mr-2"
              @click="editItem(props.item)"
              slot="activator"
            >edit</v-icon>
            <span>Editar</span>
          </v-tooltip>
          <v-tooltip bottom v-if="allowed('cobertura_combustible','delete')">
            <v-icon
              small
              color="red lighten-2"
              @click="$set(deleteDialog,props.item.id,true)"
              slot="activator"
            >delete</v-icon>
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
            <v-card-text>{{'¿Seguro que desea eliminar el hecho extraordinario?'}}</v-card-text>
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
    moduleName: 'Coberturas combustibles',
    headers: [
      { text: 'Central Eléctrica', value: 'central_electricas_id' },
      { text: 'Fecha', value: 'fechaCobertura', align: 'center' },
      { text: 'Hora', value: 'hora', align: 'center' },
      { text: 'Cap. Total Almacenada(Lts)', value: 'capacTotalAlmac', align: 'center' },
      { text: 'Existencia día anterior(Lts)', value: 'existTotalDiaAnterior', align: 'center' },
      { text: 'Existencia Total(Lts)', value: 'existTotal', align: 'center' },
      { text: 'Capacidad vacío(Lts)', value: 'capacVacio', align: 'center' },
      { text: 'Plan de reserva(Lts)', value: 'planReserva', align: 'center' },
      { text: 'Fondaje(Lts)', value: 'fondaje', align: 'center' },
      { text: 'Existencia operativa(Lts)', value: 'existOperativa', align: 'center' },
      { text: 'Cobertura x horas(Hrs)', value: 'coberturaHoras', align: 'center' },
      { text: 'Consumo(Lts)', value: 'consumo', align: 'center' },
      { text: 'Suministro CUPET(Lts)', value: 'suminCupet', align: 'center' },
      { text: 'Acciones', sortable: false, align: 'center' }
    ],
    pageitems: [
      5, 10, 30,
      { text: 'Todo', value: -1 }
    ],
    items: [],
    entidades: [],
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
          values: [],
          selectOptions: {
            noneSelectedText: 'Seleccione una central eléctrica',
            name: 'nombre',
            value: 'id'
          }
        },
        {
          type: 'input',
          inputType: 'date',
          label: 'Fecha',
          model: 'fechaCobertura',
          format: 'YYYY-MM-DD',
          visible: function ()          {
            return this.isNewModel
          }
        },
        {
          type: 'input',
          inputType: 'time',
          label: 'Hora',
          model: 'hora',
          format: 'HH:MM AM/PM'
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Cap. Total Almacenada (Lts)',
          model: 'capacTotalAlmac',
          validator: ['double'],
          max: 3
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Existencia día anterior (Lts)',
          model: 'existTotalDiaAnterior',
          validator: ['double'],
          max: 3
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Existencia Total (Lts)',
          model: 'existTotal',
          validator: ['double'],
          max: 3
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Plan de reserva (Lts)',
          model: 'planReserva',
          validator: ['double'],
          max: 3
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Fondaje (Lts)',
          model: 'fondaje',
          validator: ['double'],
          max: 3
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Cobertura x horas (Hrs)',
          model: 'coberturaHoras',
          validator: ['integer'],
          max: 500
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Consumo (Lts)',
          model: 'consumo',
          validator: ['double'],
          max: 3
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Suministro CUPET (Lts)',
          model: 'suminCupet',
          validator: ['double'],
          max: 3
        }
      ]
    }
  }),

  computed: {
    formTitle ()    {
      return this.editedIndex === -1 ? 'Nuevo' : 'Editar'
    },
    lowerModuleName ()    {
      return this.moduleName.split(' ').join('_').toLowerCase()
    }

  },

  watch: {
    dialog (val)    {
      val || this.close()
    }
  },

  mounted ()  {
    const promises = []

    promises.push(this.$store.dispatch('GET', 'centrales_electricas').then((result) =>    {
      this.centrales_electricas = this.$store.getters.get('centrales_electricas')
      this.$store.dispatch('responseMessage', {
        type: result.success ? 'success' : 'error',
        text: result.message
      })
    }).catch((err) =>    {
      this.$store.dispatch('responseMessage', {
        type: 'error',
        text: err
      })
    })
    )

    promises.push(this.$store.dispatch('GET', this.lowerModuleName).then((result) =>    {
      this.items = this.$store.getters.get(this.lowerModuleName)
      this.$store.dispatch('responseMessage', {
        type: result.success ? 'success' : 'error',
        text: result.message
      })
    }).catch((err) =>    {
      this.$store.dispatch('responseMessage', {
        type: 'error',
        text: err
      })
    })
    )

    Promise.all(promises).then(values =>    {
      var field = this.$data.schema.fields.find(field => field.model === 'central_electricas_id')
      field.values = this.centrales_electricas
    })
  },

  methods: {
    editItem (item)    {
      this.editedIndex = this.items.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    updateItem (newVal, property)    {
      // this.formIsValid()
      this.editedItem[property] = newVal
    },

    saveItem ()    {
      let response
      if (this.editedIndex === -1)      {
        response = this.$store.dispatch('SAVE', { payload: this.editedItem, moduleName: this.lowerModuleName })
      } else      {
        response = this.$store.dispatch('EDIT', { payload: this.editedItem, moduleName: this.lowerModuleName })
      }

      response.then(result =>      {
        this.$store.dispatch('responseMessage', {
          type: result.success ? 'success' : 'error',
          text: result.message
        })
        this.close()
      })
    },

    formIsValid (isValid, errors)    {
      // return isValid
      // console.log('Results ', isValid, ', Errors ', errors)
    },

    deleteItem (item)    {
      this.$store.dispatch('DESTROY', { payload: item, moduleName: this.lowerModuleName }).then((result) =>      {
        this.$store.dispatch('responseMessage', {
          type: result.success ? 'success' : 'error',
          text: result.message
        })
      }).catch((err) =>      {
        this.$store.dispatch('responseMessage', {
          type: 'error',
          text: err
        })
      })
    },

    formatDate (date)    {
      if (date)      {
        return new Date(date).toLocaleDateString()
        // return date.split(' ')[0]
      }
    },

    close ()    {
      this.dialog = false
      this.isNewModel = false
      setTimeout(() =>      {
        this.editedItem = Object.assign({}, {})
        this.editedIndex = -1
      }, 300)
    },

    centralesElectricasName (id)    {
      const centralElectrica = this.centrales_electricas.find(ce => ce.id === id)
      return centralElectrica.nombre
    }
  }
}
</script>
