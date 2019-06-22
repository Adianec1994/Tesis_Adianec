<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
  <div>
    <v-toolbar flat>
      <v-list>
        <v-list-tile>
          <v-list-tile-title class="title">
            {{ name }}
          </v-list-tile-title>
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
        <v-list-tile-title
          v-text="dashboard.title"
          class="title"
        ></v-list-tile-title>
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
              <v-list-tile-title class="title">
                {{item.title}}
              </v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>

        <v-list-tile
          v-for="(admin, i) in item.items"
          :key="i"
          :to="admin.route"
        >
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
export default {
  data () {
    return {
      name: this.$t('nav_menu_title'),
      dashboard: { title: 'Inicio', icon: 'dashboard', route: { name: 'home' }},

      items: [
        {
          title: 'Administración',
          icon: 'settings',
          active: false,
          items: [
            { title: 'Base de Datos', icon: 'backup', route: { name: 'base_datos' }},
            { title: 'Trazas', icon: 'history', route: { name: 'trazas' }},
            { title: 'Usuarios', icon: 'group', route: { name: 'usuarios' }}
          ]
        },

        {
          title: 'Datos Generales',
          icon: 'work',
          active: false,
          items: [
            { title: 'Provincias', icon: 'view_list', route: { name: 'provincias' }},
            { title: 'Entidades', icon: 'view_list', route: { name: 'entidades' }},
            { title: 'Centrales Eléctricas', icon: 'view_list', route: { name: 'centrales_electricas' }},
            { title: 'Baterías', icon: 'view_list', route: { name: 'baterias' }},
            { title: 'Grupos', icon: 'view_list', route: { name: 'grupos' }},
            { title: 'Proveedores', icon: 'view_list', route: { name: 'proveedores' }},
            { title: 'Mantenedores Externos', icon: 'view_list', route: { name: 'mantenedores_externos' }},
            { title: 'Operadores', icon: 'view_list', route: { name: 'operadores' }}
          ]
        },

        {
          title: 'Combustible',
          icon: 'flash_on',
          active: false,
          items: [
            { title: 'Materia de Servicios', icon: 'calendar_view_day', route: { name: 'datos_generales' }},
            { title: 'Generaciones', icon: 'calendar_view_day', route: { name: 'generaciones' }},
            { title: 'Pailas', icon: 'calendar_view_day', route: { name: 'pailas' }},
            { title: 'Coberturas Combustibles', icon: 'calendar_view_day', route: { name: 'coberturas_combustibles' }}
          ]
        },

        {
          title: 'Producción',
          icon: 'business_center',
          active: false,
          items: [
            { title: 'Eventos Diarios', icon: 'menu', route: { name: 'eventos_diarios' }},
            { title: 'Planes', icon: 'menu', route: { name: 'planes' }},
            { title: 'Disponbilidades', icon: 'menu', route: { name: 'disponibilidades' }},
            { title: 'Hechos Extraordinarios', icon: 'menu', route: { name: 'hechos_extraordinarios' }}
          ]
        },

        {
          title: 'Reportes',
          icon: 'business_center',
          active: false,
          items: [
            { title: 'Existencia de Lubricantes', icon: 'menu', route: { name: '8' }}
            // { title: 'Planes', icon: 'menu', route: { name: 'planes' }},
            // { title: 'Disponbilidades', icon: 'menu', route: { name: 'disponibilidades' }},
            // { title: 'Hechos Extraordinarios', icon: 'menu', route: { name: 'hechos_extraordinarios' }}
          ]
        }
      ]
    }
  }
}
</script>
