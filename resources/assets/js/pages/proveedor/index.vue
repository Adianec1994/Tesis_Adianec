<template>
  <div>
    <v-toolbar
      flat
      color="white"
    >
      <v-toolbar-title>Proveedores</v-toolbar-title>
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
      :items="proveedores"
      class="elevation-1"
    >
      <template v-slot:items="props">
        <td>{{ props.item.marca }}</td>
        <td class="text-xs-center">{{ props.item.serie }}</td>
        <td class="text-xs-center">{{ props.item.paiss_id }}</td>
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
            <v-card-text>{{`¿Seguro que desea eliminar el proveedor ${props.item.marca}`}}</v-card-text>
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
        <v-btn color="primary">Reset</v-btn>
      </template>
    </v-data-table>
  </div>
</template>

<script>
import Form from '../../components/form/Form'
import { mapGetters } from 'vuex'

export default {
  data: () => ({
    dialog: false,
    headers: [
      { text: 'Marca', value: 'marca' },
      { text: 'Serie', value: 'serie', align: 'center' },
      { text: 'Pais', value: 'pais', align: 'center' },
      { text: 'Acciones', value: 'marca', sortable: false, align: 'center' }
    ],
    deleteDialog: {},
    proveedores: [],
    editedItem: {},
    editedIndex: -1,
    isNewModel: false,
    options: {
      validateAfterChanged: true,
      validateAfterLoad: true
    },
    schema: {
      fields: [
        {
          type: 'input',
          inputType: 'text',
          label: 'Marca',
          model: 'marca'
        },
        {
          type: 'input',
          inputType: 'text',
          label: 'Serie',
          model: 'serie'
        },
        {
          type: 'select',
          label: 'Pais',
          model: 'paiss_id',
          values: [
            { name: 'Cuba', id: '1', group: 'MotoGP' },
            { name: 'Francia', id: '2', group: 'Formula 1' }
          ]
        }
      ]
    }
  }),

  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'Nuevo' : 'Editar'
    },
    ...mapGetters({
      proveedores: 'getProveedores'
    })
  },

  watch: {
    dialog (val) {
      val || this.close()
    }
  },

  mounted () {
    this.$store.dispatch('GET_PROVEEDORES').then((result) => {
      this.proveedores = this.$store.getters.getProveedores
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

  methods: {
    editItem (item) {
      this.editedIndex = this.proveedores.indexOf(item)
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
        response = this.$store.dispatch('SAVE_PROVEEDOR', this.editedItem)
      } else {
        response = this.$store.dispatch('EDIT_PROVEEDOR', this.editedItem)
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
      this.$store.dispatch('DESTROY_PROVEEDOR', item).then((result) => {
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
    }
  },
  components: {
    Form
  }
}
</script>
