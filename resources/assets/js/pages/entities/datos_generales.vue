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
        <td>{{ centralesElectricasName(props.item.central_electricas_id) }}</td>
        <td class="text-xs-center justify-center">{{ props.item.genBruta }}</td>
        <td class="text-xs-center justify-center">{{ props.item.insumos }}</td>
        <td class="text-xs-center justify-center">{{ props.item.recibido }}</td>
        <td class="text-xs-center justify-center">{{ props.item.volumenRecibido }}</td>
        <td class="text-xs-center justify-center">{{ props.item.consumoGeneracion }}</td>
        <td class="text-xs-center justify-center">{{ props.item.densidadPonderada }}</td>
        <td class="text-xs-center justify-center">{{ props.item.temperatura }}</td>
        <td class="text-xs-center justify-center">{{ props.item.densidadCorreccion }}</td>
        <td class="text-xs-center justify-center">{{ props.item.valorCalorico }}</td>
        <td class="text-xs-center justify-center">{{ props.item.existencia }}</td>
        <td class="text-xs-center justify-center">{{ props.item.cobertura }}</td>
        <td class="text-xs-center justify-center">{{ props.item.indiceConsumo }}</td>
        <td class="text-xs-center justify-center">{{ props.item.lubricteRecibido }}</td>
        <td class="text-xs-center justify-center">{{ props.item.lubricteCsmoReposicion }}</td>
        <td class="text-xs-center justify-center">{{ props.item.lubricteCsmoCambio }}</td>
        <td class="text-xs-center justify-center">{{ props.item.lubricteCsmoTotal }}</td>
        <td class="text-xs-center justify-center">{{ props.item.lubricteExistencia }}</td>
        <td class="text-xs-center justify-center">{{ props.item.lubricteCobertura }}</td>
        <td class="text-xs-center justify-center">{{ props.item.lubricteIndiceCsmo }}</td>
        <td class="text-xs-center justify-center">{{ props.item.refrigteRecibido }}</td>
        <td class="text-xs-center justify-center">{{ props.item.refrigteConsumo }}</td>
        <td class="text-xs-center justify-center">{{ props.item.refrigteExistencia }}</td>
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
    moduleName: 'Datos generales',
    headers: [
      { text: 'Central Eléctrica', value: 'central_electricas_id' },
      { text: 'Generación bruta', value: 'genBruta', align: 'center' },
      { text: 'Insumos', value: 'insumos', align: 'center' },
      { text: 'Recibido', value: 'recibido', align: 'center' },
      { text: 'Volumen recibido', value: 'volumenRecibido', align: 'center' },
      { text: 'Consumo generación', value: 'consumoGeneracion', align: 'center' },
      { text: 'Densidad ponderada', value: 'densidadPonderada', align: 'center' },
      { text: 'Temperatura', value: 'temperatura', align: 'center' },
      { text: 'Densidad corrección', value: 'densidadCorreccion', align: 'center' },
      { text: 'Valor calórico', value: 'valorCalorico', align: 'center' },
      { text: 'Existencia', value: 'existencia', align: 'center' },
      { text: 'Cobertura', value: 'cobertura', align: 'center' },
      { text: 'Índice de consumo', value: 'indiceConsumo', align: 'center' },
      { text: 'Lubricante recibido', value: 'lubricteRecibido', align: 'center' },
      { text: 'Lubricante consumo reposición', value: 'lubricteCsmoReposicion', align: 'center' },
      { text: 'Lubricante consumo cambio', value: 'lubricteCsmoCambio', align: 'center' },
      { text: 'Lubricante consumo total', value: 'lubricteCsmoTotal', align: 'center' },
      { text: 'Lubricante existencia', value: 'lubricteExistencia', align: 'center' },
      { text: 'Lubricante cobertura', value: 'lubricteCobertura', align: 'center' },
      { text: 'Lubricante índice consumo', value: 'lubricteIndiceCsmo', align: 'center' },
      { text: 'Refrigerante recibido', value: 'refrigteRecibido', align: 'center' },
      { text: 'Refrigerante consumo', value: 'refrigteConsumo', align: 'center' },
      { text: 'Refrigerante existencia', value: 'refrigteExistencia', align: 'center' },
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
          inputType: 'text',
          label: 'Generación bruta',
          model: 'genBruta',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Insumos',
          model: 'insumos',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Recibido',
          model: 'recibido',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Volumen recibido',
          model: 'volumenRecibido',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Consumo generación',
          model: 'consumoGeneracion',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Densidad ponderada',
          model: 'densidadPonderada',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Temperatura',
          model: 'temperatura',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Densidad corrección',
          model: 'densidadCorreccion',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Valor calórico',
          model: 'valorCalorico',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Existencia',
          model: 'existencia',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Cobertura',
          model: 'cobertura',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Índice de consumo',
          model: 'indiceConsumo',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Lubricante recibido',
          model: 'lubricteRecibido',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Lubricante consumo reposición',
          model: 'lubricteCsmoReposicion',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Lubricante consumo cambio',
          model: 'lubricteCsmoCambio',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Lubricante consumo total',
          model: 'lubricteCsmoTotal',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Lubricante existencia',
          model: 'lubricteExistencia',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Lubricante cobertura',
          model: 'lubricteCobertura',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Lubricante índice consumo',
          model: 'lubricteIndiceCsmo',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Refrigerante recibido',
          model: 'refrigteRecibido',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Refrigerante consumo',
          model: 'refrigteConsumo',
          validator: ['double'],
          max: 4
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Refrigerante existencia',
          model: 'refrigteExistencia',
          validator: ['double'],
          max: 4
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
    }
  }
}
</script>
