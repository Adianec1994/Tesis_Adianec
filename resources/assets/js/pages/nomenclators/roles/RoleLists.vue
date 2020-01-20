<template>
  <div class="component-wrap">
    <!-- search -->
    <v-card>
      <v-card-text>
        <v-layout row wrap>
          <v-flex xs12 sm2>
            <v-btn @click="$router.push({name:'roles.create'})" class="blue" dark>
              Nuevo Rol
              <v-icon right>add</v-icon>
            </v-btn>
          </v-flex>
          <v-flex xs12 sm7 class="my-2"></v-flex>
          <v-flex xs12 sm2>
            <v-text-field prepend-icon="search" label="Nombre" v-model="filters.nombre"></v-text-field>
          </v-flex>
        </v-layout>
      </v-card-text>
    </v-card>
    <!-- /search -->

    <!-- groups table -->
    <v-data-table v-bind:headers="headers" :items="items" class="elevation-1">
      <template slot="headerCell" slot-scope="props">
        <span v-if="props.header.value=='name'">{{ props.header.text }}</span>
        <span v-else-if="props.header.value=='users_count'">{{ props.header.text }}</span>
        <span v-else-if="props.header.value=='created_at'">{{ props.header.text }}</span>
        <span v-else>{{ props.header.text }}</span>
      </template>
      <template slot="items" slot-scope="props">
        <td style="width: 27%;">{{ props.item.name }}</td>
        <td style="width: 27%;">{{ props.item.users_count }}</td>
        <td style="width: 27%;">{{ props.item.created_at }}</td>
        <td style="width: 17%;">
          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn
                style="margin: 0;"
                v-on="on"
                @click="$router.push({name:'roles.edit',params:{id: props.item.id}})"
                icon
                small
              >
                <v-icon class="blue--text">edit</v-icon>
              </v-btn>
            </template>
            <span>Editar</span>
          </v-tooltip>
          <v-tooltip bottom>
            <v-btn
              style="margin: 0;"
              @click="$set(deleteDialog,props.item.id,true)"
              slot="activator"
              icon
              small
            >
              <v-icon class="red--text">delete</v-icon>
            </v-btn>
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
            <v-card-text>{{`¿Seguro que desea eliminar el rol ${props.item.name}`}}</v-card-text>
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
    headers: [
      { text: 'Nombre', value: 'name', align: 'left', sortable: false },
      {
        text: 'Miembros',
        value: 'users_count',
        align: 'left',
        sortable: false
      },
      { text: 'Creado', value: 'created_at', align: 'left', sortable: false },
      { text: 'Acciones', value: false, align: 'left', sortable: false }
    ],
    items: [],
    deleteDialog: {},
    moduleName: 'Roles',

    filters: {
      nombre: ''
    }
  }),
  mounted () {
    this.loadGroups()
  },
  computed: {
    lowerModuleName () {
      return this.moduleName.toLowerCase()
    }
  },
  methods: {
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
    loadGroups (cb) {
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
  }
}
</script>
