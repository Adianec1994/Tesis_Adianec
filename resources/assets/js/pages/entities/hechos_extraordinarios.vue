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
      :rows-per-page-text="'Filas por páginas'"
      :rows-per-page-items="pageitems"
      class="elevation-1"
    >
      <template v-slot:items="props">
        <td>{{ entidadName(props.item.entidads_id) }}</td>
        <td class="text-xs-center justify-center">{{ props.item.tipo }}</td>
        <td class="text-xs-center justify-center">{{ props.item.created_at }}</td>
        <td class="text-xs-center justify-center">{{ props.item.descripcion }}</td>
        <td class="text-xs-center justify-center">{{ props.item.medidas }}</td>
        <td class="text-xs-center justify-center">{{ props.item.nombreImplicado }}</td>
        <td class="text-xs-center justify-center">{{ props.item.nombreInforma }}</td>
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
    moduleName: 'Hechos extraordinarios',
    headers: [
      { text: 'Entidad', value: 'entidads_id' },
      { text: 'Tipo de hecho', value: 'tipo', align: 'center' },
      { text: 'Fecha', value: 'created_at', align: 'center' },
      { text: 'Descripción', value: 'descripcion', align: 'center' },
      { text: 'Medidas', value: 'medidas', align: 'center' },
      { text: 'Implicados', value: 'nombreImplicados', align: 'center' },
      { text: 'Informa', value: 'nombreInforma', align: 'center' },
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
          type: 'input',
          inputType: 'text',
          label: 'Tipo de hecho',
          model: 'tipo',
          validator: ['nombre']
        },*/
        {
          type: 'select',
          label: 'Tipo de hecho',
          model: 'tipo',
          values: [
            'Hurto',
            'Daño',
            'Derrame',
            'Sabotaje',
            'Corrupción',
            'Robo con fuerza',
            'Apropiación indebida',
            'Accidentes de tránsito',
            'No preservar los bienes del Estado'
          ],
          selectOptions: {
            noneSelectedText: 'Seleccione el tipo de hecho'
          }
        },
        {
          type: 'textArea',
          label: 'Descripción',
          model: 'descripcion',
          placeholder: 'Detalle brevemente el hecho...',
          rows: 3
        },
        {
          type: 'textArea',
          label: 'Medidas',
          model: 'medidas',
          placeholder: 'Detalle brevemente las medidas tomadas...',
          rows: 3
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Nombre de los implicados',
          model: 'nombreImplicado',
          validator: ['nombre']
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Nombre del que informa',
          model: 'nombreInforma',
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

    entidadName (id) {
      const entidad = this.entidades.find(e => e.id === id)
      return entidad.nombre
    }
  }
}
</script>
