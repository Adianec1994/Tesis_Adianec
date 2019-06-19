<template>
  <v-card>
    <v-card-title>
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
          label="Buscar"
          single-line
          hide-details
        ></v-text-field>
      </v-toolbar>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="items"
      :search="search"
    >
      <template v-slot:items="props">
        <td>{{ props.item.created_at }}</td>
        <td class="text-xs-center">{{ usuarioName(props.item.users_id) }}</td>
        <td class="text-xs-center">{{ usuarioRol(props.item.users_id) }}</td>
        <td class="text-xs-center">{{ props.item.accion }}</td>
        <td class="text-xs-center">{{ props.item.ip }}</td>
        <td class="text-xs-center">{{ props.item.url }}</td>
      </template>
      <template v-slot:no-results>
        <h4>Su búsqueda por "{{ search }}" no encontró resultados</h4>
      </template>
      <template v-slot:no-data>
        <h4>Sin resultados para mostrar</h4>
      </template>
    </v-data-table>
  </v-card>
</template>

<script>

export default {
  data: () => ({
    search: '',
    moduleName: 'Trazas',
    headers: [
      { text: 'Fecha y Hora', value: 'created_at' },
      { text: 'Usuario', align: 'center', value: 'users_id' },
      { text: 'Rol', align: 'center' },
      { text: 'Acción', value: 'accion', align: 'center' },
      { text: 'IP', value: 'ip', align: 'center' },
      { text: 'URL', value: 'url', align: 'center' }
    ],
    items: [],
    usuarios: []
  }),

  computed: {
    lowerModuleName () {
      return this.moduleName.toLowerCase()
    }
  },

  mounted () {
    const promises = []

    promises.push(this.$store.dispatch('GET', 'usuarios').then((result) => {
      this.usuarios = this.$store.getters.get('usuarios')
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

    Promise.all(promises)
  },

  methods: {
    usuarioName (id) {
      if (id) {
        const usuario = this.usuarios.find(u => u.id === id)
        return usuario.name
      }
      return '-'
    },
    usuarioRol (id) {
      if (id) {
        const usuario = this.usuarios.find(u => u.id === id)
        return usuario.cargo
      }
      return '-'
    }
  }
}
</script>
