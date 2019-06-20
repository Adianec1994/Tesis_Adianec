<template>
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
    <v-list>
      <v-list-tile
        value="true"
        v-for="(item, i) in items"
        :key="i"
        :to="item.route"
      >
        <v-list-tile-action>
          <v-icon light v-html="item.icon"></v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title v-text="item.title"></v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
    </v-list>
  </div>
</template>

<script>
export default {
  data () {
    return {
      name: this.$t('nav_menu_title'),
      items: [
        { title: 'Dashboard', icon: 'dashboard', route: { name: 'home' }},
        { title: this.$t('account'), icon: 'account_box', route: { name: 'settings.profile' }},
        { title: 'Proveedores', icon: 'account_box', route: { name: 'proveedores' }},
        { title: 'Provincias', icon: 'account_box', route: { name: 'provincias' }},
        { title: 'Disponbilidades', icon: 'account_box', route: { name: 'disponibilidades' }},
        { title: 'Entidades', icon: 'account_box', route: { name: 'entidades' }},
        { title: 'Hechos Extraordinarios', icon: 'account_box', route: { name: 'hechos_extraordinarios' }},
        { title: 'Planes', icon: 'account_box', route: { name: 'planes' }},
        { title: 'Centrales Eléctricas', icon: 'account_box', route: { name: 'centrales_electricas' }},
        { title: 'Baterías', icon: 'account_box', route: { name: 'baterias' }},
        { title: 'Coberturas Combustibles', icon: 'account_box', route: { name: 'coberturas_combustibles' }},
        { title: 'Datos Generales', icon: 'account_box', route: { name: 'datos_generales' }},
        { title: 'Operadores', icon: 'account_box', route: { name: 'operadores' }},
        { title: 'Pailas', icon: 'account_box', route: { name: 'pailas' }},
        { title: 'Grupos', icon: 'account_box', route: { name: 'grupos' }},
        { title: 'Eventos Diarios', icon: 'account_box', route: { name: 'eventos_diarios' }},
        { title: 'Generaciones', icon: 'account_box', route: { name: 'generaciones' }},
        { title: 'Usuarios', icon: 'account_box', route: { name: 'usuarios' }},
        { title: 'Trazas', icon: 'account_box', route: { name: 'trazas' }},
        { title: 'Mantenedores Externos', icon: 'account_box', route: { name: 'mantenedores_externos' }},
        { title: 'Base Datos', icon: 'account_box', route: { name: 'base_datos' }}
      ]
    }
  }
}
</script>
