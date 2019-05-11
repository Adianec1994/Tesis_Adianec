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
                  @model-updated="updateItem"
                  @validated="formIsValid"
                >
                </vue-form-generator>
              </v-layout>
            </v-container>
          </v-card-text>

          <!-- <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="blue darken-1"
              flat
              @click="close"
            >Cancel</v-btn>
            <v-btn
              color="blue darken-1"
              flat
              @click="save"
            >Save</v-btn>
          </v-card-actions> -->
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
            @click="deleteItem(props.item)"
          >
            delete
          </v-icon>
        </td>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary">Reset</v-btn>
      </template>
    </v-data-table>
  </div>
</template>

<script>
import Form from '../../components/form/Form'

export default {
  data: () => ({
    dialog: false,
    headers: [
      { text: 'Marca', value: 'marca' },
      { text: 'Serie', value: 'serie', align: 'center' },
      { text: 'Pais', value: 'pais', align: 'center' },
      { text: 'Acciones', value: 'marca', sortable: false, align: 'center' }
    ],
    proveedores: [],
    editedItem: {},
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
          model: 'pais',
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
    }
  },

  watch: {
    dialog (val) {
      val || this.close()
    }
  },

  created () {
    this.$store.dispatch('GET_PROVEEDORES')
  },

  mounted () {
    this.proveedores = this.$store.getters.getProveedores
  },

  methods: {
    editItem (item) {
      this.editedIndex = this.proveedores.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    updateItem (newVal, property) {
      this.formIsValid()
      console.log(newVal + '---' + property)
    },

    formIsValid (isValid, errors) {
      // return isValid
      console.log('Results ', isValid, ', Errors ', errors)
    },

    deleteItem (item) {
      const index = this.proveedores.indexOf(item)
      confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
    },

    close () {
      this.dialog = false
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      }, 300)
    },

    save () {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem)
      } else {
        this.desserts.push(this.editedItem)
      }
      this.close()
    }
  },
  components: {
    Form
  }
}
</script>
