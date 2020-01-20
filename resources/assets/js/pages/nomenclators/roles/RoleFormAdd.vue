<template>
  <div class="component-wrap">
    <!-- form -->
    <v-card>
      <v-card-title>
        <v-icon>groups</v-icon>Crear Rol
      </v-card-title>
      <v-divider></v-divider>
      <v-form v-model="valid" ref="groupFormAdd" lazy-validation>
        <v-container grid-list-md>
          <v-layout row wrap>
            <v-flex xs12>
              <div class="body-2 white--text">Detalles del Rol</div>
            </v-flex>
            <v-flex xs3>
              <v-text-field label="Nombre del Rol*" v-model="name" :rules="nameRules"></v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-card>
                <v-container fluid grid-list-md>
                  <v-layout align-center justify-space-between fill-height row wrap>
                    <v-flex md12 xs12>
                      <v-card>
                        <v-container fill-height fluid pa-2>
                          <v-flex xs12 sm4>
                            <v-layout row wrap>
                              <v-switch
                                v-model="mustInherit"
                                label="Heredar permisos desde otro rol"
                              ></v-switch>
                            </v-layout>
                          </v-flex>
                          <v-flex xs12 sm3>
                            <v-select
                              :items="roles"
                              v-model="inheritFromRole"
                              label="Rol"
                              v-if="mustInherit"
                              item-text="name"
                              item-value="id"
                            ></v-select>
                          </v-flex>
                        </v-container>
                      </v-card>
                    </v-flex>
                    <v-flex sm5 xs12>
                      <v-card>
                        <v-container fill-height fluid pa-2>
                          <v-layout column fill-height>
                            <v-subheader>Todos los permisos</v-subheader>
                            <v-list style="overflow-y:auto; height: 12rem">
                              <v-list-tile
                                v-for="ap in allPermissions"
                                :key="ap.name+ap.id"
                                v-ripple
                              >
                                <v-checkbox
                                  :id="ap.name"
                                  v-model="toAdd"
                                  :value="ap"
                                  :label="ap.name"
                                ></v-checkbox>
                              </v-list-tile>
                            </v-list>
                          </v-layout>
                        </v-container>
                      </v-card>
                    </v-flex>

                    <v-flex sm2 xs12>
                      <v-container fill-height fluid pa-2>
                        <v-layout fill-height column justify-space-between align-center>
                          <v-btn fab small dark @click="SelectPermissions(toAdd)" color="primary">
                            <b>></b>
                          </v-btn>
                          <v-btn
                            fab
                            small
                            dark
                            @click="SelectPermissions(allPermissions)"
                            color="primary"
                          >
                            <b>>></b>
                          </v-btn>
                          <v-btn fab small dark @click="RemovePermissions(toRemove)" color="red">
                            <b><</b>
                          </v-btn>
                          <v-btn
                            fab
                            small
                            dark
                            @click="RemovePermissions(selectedPermissions)"
                            color="red"
                          >
                            <b><<</b>
                          </v-btn>
                        </v-layout>
                      </v-container>
                    </v-flex>

                    <v-flex sm5 xs12>
                      <v-card>
                        <v-container fill-height fluid pa-2>
                          <v-layout column fill-height>
                            <v-subheader>Permisos seleccionados</v-subheader>

                            <v-list style="overflow-y:auto; height: 12rem">
                              <v-list-tile
                                v-for="sp in selectedPermissions"
                                :key="sp.name+sp.id"
                                v-ripple
                              >
                                <v-checkbox
                                  :id="sp.name"
                                  v-model="toRemove"
                                  :value="sp"
                                  :label="sp.name"
                                ></v-checkbox>
                              </v-list-tile>
                            </v-list>
                          </v-layout>
                        </v-container>
                      </v-card>
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-card>
            </v-flex>
            <v-flex xs12 class="px-2 text-xs-right">
              <v-btn @click="save()" :disabled="!valid" color="blue" dark>Guardar</v-btn>
            </v-flex>
          </v-layout>
        </v-container>
      </v-form>
    </v-card>
    <!-- /form -->
  </div>
</template>

<script>
export default {
  data () {
    return {
      valid: false,
      name: '',
      nameRules: [
        v => !!v || 'El Nombre del Rol es Necesario',
        v => this.letrasV(v) || 'Solo letras',
        v => this.signosV(v) || 'Solo letras'
      ],
      allPermissions: [],
      selectedPermissions: [],
      toAdd: [],
      toRemove: [],
      mustInherit: false,
      inheritFromRole: '',
      roles: []
    }
  },
  watch: {
    'mustInherit': function () {
      this.mustInherit ? this.loadRoles() : this.inheritFromRole = ''
    },
    'inheritFromRole': function () {
      this.loadPermissions()
    }
  },
  mounted () {
    const self = this

    self.loadPermissions(() => { })
  },
  methods: {
    letrasV (v) {
      return !(
        v.includes('1') ||
        v.includes('2') ||
        v.includes('3') ||
        v.includes('4') ||
        v.includes('5') ||
        v.includes('6') ||
        v.includes('7') ||
        v.includes('8') ||
        v.includes('9') ||
        v.includes('0')
      )
    },
    signosV (v) {
      return !(
        v.includes(',') ||
        v.includes('.') ||
        v.includes('-') ||
        v.includes('*') ||
        v.includes('/') ||
        v.includes('+') ||
        v.includes('!') ||
        v.includes('@') ||
        v.includes('#') ||
        v.includes('$') ||
        v.includes(';') ||
        v.includes(':') ||
        v.includes('[') ||
        v.includes(']') ||
        v.includes('{') ||
        v.includes('}') ||
        v.includes('=') ||
        v.includes('_') ||
        v.includes('&') ||
        v.includes('%')
      )
    },
    save () {
      const self = this

      const payload = {
        name: self.name,
        permisos: self.selectedPermissions
      }

      axios
        .post('/api/roles', payload)
        .then(function (response) {
          self.$store.dispatch('responseMessage', {
            type: response.data.success ? 'success' : 'error',
            text: response.data.message
          })
          self.$router.push({ path: '/roles' })
        })
        .catch(function (error) {
          if (error.response) {
            self.$store.dispatch('responseMessage', {
              type: 'error',
              text: error.response.data.message
            })
          }
        })
    },
    loadPermissions () {
      const self = this

      self.selectedPermissions = []
      self.allPermissions = []

      const params = {
        paginate: 'no',
        inheritFromRole: self.inheritFromRole
      }

      axios
        .get('/api/permisos', { params: params })
        .then(function (response) {
          self.selectedPermissions = response.data.data.selectedPermissions ? response.data.data.selectedPermissions : []
          self.allPermissions = response.data.data.allPermissions
        })
    },
    loadRoles () {
      const self = this
      const params = {
        paginate: 'no'
      }
      axios.get('/api/roles', { params: params }).then(function (response) {
        self.roles = response.data.data
      })
    },
    SelectPermissions (from) {
      const self = this
      const permissions = [...from]
      permissions.forEach((permission) => {
        self.selectedPermissions.push(permission)
        self.allPermissions.splice(self.allPermissions.indexOf(permission), 1)
      })
      self.toAdd = []
    },
    RemovePermissions (from) {
      const self = this
      const permissions = [...from]
      permissions.forEach((permission) => {
        self.allPermissions.push(permission)
        self.selectedPermissions.splice(self.selectedPermissions.indexOf(permission), 1)
      })
      self.toRemove = []
    }
  }
}
</script>
