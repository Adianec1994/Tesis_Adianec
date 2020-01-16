<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
  <div>
    <v-toolbar flat>
      <v-list>
        <v-list-tile>
          <v-list-tile-title class="title">{{ name }}</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-toolbar>
    <v-divider></v-divider>

    <!--Inicio-->
    <v-list-tile :to="dashboard.route">
      <v-list-tile-action>
        <v-icon v-html="dashboard.icon"></v-icon>
      </v-list-tile-action>
      <v-list-tile-content>
        <v-list-tile-title v-text="dashboard.title" class="title"></v-list-tile-title>
      </v-list-tile-content>
    </v-list-tile>
    <!--Dropdowns-->
    <v-list>
      <v-list-group
        :prepend-icon="item.icon"
        v-for="item in items"
        :key="item.title"
        v-model="item.active"
        no
        action
      >
        <template v-slot:activator>
          <v-list-tile>
            <v-list-tile-content>
              <v-list-tile-title class="title">{{item.title}}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>

        <v-list-tile v-for="(admin, i) in item.items" :key="i" :to="admin.route">
          <v-list-tile-action>
            <v-icon v-html="admin.icon"></v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title v-text="admin.title"></v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list-group>
    </v-list>
  </div>
</template>

<script>
import Permit from '../common/Permit.js'
import axios from 'axios'

export default {
  mixins: [Permit],
  mounted () {
    axios.get('/api/nav').then(response => {
      this.items = response.data
    })
  },
  data () {
    return {
      name: this.$t('nav_menu_title'),
      dashboard: { title: 'Inicio', icon: 'dashboard', route: { name: 'home' } },

      items: []
    }
  }
}
</script>
