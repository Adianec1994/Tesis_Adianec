<template>
  <v-layout justify-center>
    <v-flex
      xs12
      sm12
    >
      <v-toolbar
        color="blue"
        dark
      >
        <v-toolbar-title>Salvar y restaurar la base de datos</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn
          dark
          color="primary"
          class="mb-2"
          v-on:click="createBackup()"
        >
          <v-icon>save</v-icon>
          Salvar
        </v-btn>
      </v-toolbar>

      <v-card>
        <v-container
          fluid
          grid-list-md
        >
          <v-layout
            row
            wrap
          >
            <v-flex
              v-for="snapshot in snapshots"
              :key="snapshot.title"
              xs3
            >
              <v-card>
                <v-container
                  fill-height
                  fluid
                  pa-2
                >
                  <v-layout fill-height>
                    <v-flex
                      xs12
                      align-end
                      flexbox
                    >
                      <span
                        class="title black--text"
                        v-text="snapshot.filename"
                      ></span>
                      <span
                        class="black--text"
                      >Tamaño: {{formatSize(snapshot.size)}}</span>
                    </v-flex>
                  </v-layout>
                </v-container>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-tooltip bottom>
                  <v-btn
                    icon
                    v-on:click="restoreBackup(snapshot.filename)"
                    slot="activator"
                  >
                    <v-icon>restore</v-icon>
                  </v-btn>
                    <span>Restaurar</span>
                  </v-tooltip>
                  <v-tooltip bottom>
                  <v-btn
                    icon
                    v-on:click="deleteBackup(snapshot.filename)"
                    slot="activator"
                  >
                    <v-icon>delete</v-icon>
                  </v-btn>
                    <span>Eliminar</span>
                  </v-tooltip>
                </v-card-actions>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import axios from 'axios'

export default {
  data: () => ({
    snapshots: []
  }),

  mounted () {
    axios.get('/api/snapshots').then((result) => {
      this.snapshots = result.data.data

      this.$store.dispatch('responseMessage', {
        type: result.data.success ? 'success' : 'error',
        text: result.data.message
      })
    }).catch((err) => {
      this.$store.dispatch('responseMessage', {
        type: 'error',
        text: err
      })
    })
  },

  methods: {
    deleteBackup (title) {
      axios.delete(`/api/snapshots/${title}`).then(result => {
        const delIndex = this.snapshots.findIndex(el => el.filename === title)
        this.snapshots.splice(delIndex, 1)
        this.$store.dispatch('responseMessage', {
          type: result.data.success ? 'success' : 'error',
          text: result.data.message
        })
      }).catch((err) => {
        this.$store.dispatch('responseMessage', {
          type: 'error',
          text: err
        })
      })
    },

    restoreBackup (title) {
      axios.post(`/api/snapshots/${title}`).then(result => {
        this.$store.dispatch('responseMessage', {
          type: result.data.success ? 'success' : 'error',
          text: result.data.message
        })
      }).catch((err) => {
        this.$store.dispatch('responseMessage', {
          type: 'error',
          text: err
        })
      })
    },

    createBackup () {
      axios.post(`/api/snapshots`).then(result => {
        this.snapshots = result.data.data
        this.$store.dispatch('responseMessage', {
          type: result.data.success ? 'success' : 'error',
          text: result.data.message
        })
      }).catch((err) => {
        this.$store.dispatch('responseMessage', {
          type: 'error',
          text: err
        })
      })
    },

    formatSize (size, c = -1) {
      // caso base
      if (size < 1024) {
        let denominacion
        switch (c) {
          case 1:
            denominacion = 'M'
            break
          case 2:
            denominacion = 'G'
            break
          case 3:
            denominacion = 'T'
            break
          default:
            denominacion = 'K'
        }
        return `${_.ceil(size, 2)} ${denominacion}b`
      }
      c++
      size /= 1024

      return this.formatSize(size, c)
    }
  }
}
</script>
