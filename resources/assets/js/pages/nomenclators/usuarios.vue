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
        <td>{{ props.item.name }}</td>
        <td class="text-xs-center justify-center">{{ activoName(props.item.accepted) }}</td>
        <td class="text-xs-center justify-center">{{ props.item.cargo }}</td>
        <td class="text-xs-center justify-center">{{ props.item.username }}</td>
        <td class="text-xs-center justify-center">{{ props.item.email }}</td>
        <td class="text-xs-center justify-center">
          <v-icon
            small
            class="mr-2"
            @click="editItem(props.item)"
          >
            edit
          </v-icon>
          <v-icon
            v-if="props.item.id != idUserAuth"
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
            <v-card-text>{{`¿Seguro que desea eliminar el usuario ${props.item.name}`}}</v-card-text>
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
import axios from 'axios'

export default {
  data: () => ({
    dialog: false,
    deleteDialog: {},
    editedItem: {},
    editedIndex: -1,
    isNewModel: false,
    moduleName: 'Usuarios',
    headers: [
      { text: 'Nombre', value: 'name' },
      { text: 'Activo', value: 'accepted', align: 'center' },
      { text: 'Cargo', value: 'cargo', align: 'center' },
      { text: 'Usuario', value: 'username', align: 'center' },
      { text: 'email', value: 'email', align: 'center' },
      { text: 'Acciones', sortable: false, align: 'center' }
    ],
    items: [],
    roles: [],
    options: {
      validateAfterChanged: true,
      validateAfterLoad: true
    },
    schema: {
      fields: [
        {
          type: 'input',
          inputType: 'text',
          label: 'Nombre completo',
          model: 'name'
        },
        {
          type: 'switch',
          label: 'Activo',
          model: 'accepted',
          textOn: 'Si',
          textOff: 'No'
        },
        {
          type: 'input',
          inputType: 'password',
          label: 'Contraseña',
          model: 'password',
          hint: 'Mínimo 8 caracteres',
          min: 8
        },
        {
          type: 'select',
          label: 'Cargo',
          model: 'cargo',
          values: [],
          selectOptions: {
            hideNoneSelectedText: true,
            name: 'name',
            value: 'name'
          }
        },
        {
          type: 'select',
          label: 'Entidad',
          model: 'entidads_id',
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
          label: 'Usuario',
          model: 'username'
        },
        {
          type: 'input',
          inputType: 'email',
          label: 'Email',
          model: 'email'
        }
      ]
    }
  }),

  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'Nuevo' : 'Editar'
    },
    idUserAuth () {
      return this.$store.getters.authUser.id
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
    promises.push(axios.get('/api/roles').then((result) => {
      this.roles = result.data.data
    }))

    promises.push(this.$store.dispatch('GET', 'entidades').then((result) => {
      this.entidades = this.$store.getters.get('entidades')
      this.$store.dispatch('responseMessage', {
        type: result.success ? 'success' : 'error',
        text: result.message,
        modal: false
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
        text: result.message,
        modal: false
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

      var fieldCargo = this.$data.schema.fields.find(field => field.model === 'cargo')
      fieldCargo.values = this.roles
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

    activoName (activo) {
      const res = activo ? 'Sí' : 'No'
      return res
    }
  }
}
</script>
