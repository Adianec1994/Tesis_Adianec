<template>
  <div class="component-wrap">
    <v-card class="pt-3">
      <v-layout row wrap>
        <v-flex xs12 sm4 class="px-2">
          <!-- <a :href="url"> -->
          <v-btn class="blue" dark @click="download()">
            Descargar reporte
            <v-icon right dark>archive</v-icon>
          </v-btn>
          <!-- </a> -->
        </v-flex>

        <v-flex xs12 class="my-2">
          <v-divider></v-divider>
        </v-flex>

        <!-- filters -->
        <v-layout row wrap v-if="report.numero === 2">
          <v-flex xs12 sm6 class="px-2">
            <v-text-field prepend-icon="search" label="Filtrar por Nombre"></v-text-field>
          </v-flex>
        </v-layout>

        <v-layout row wrap>
          <v-flex xs12 sm4 class="px-2" v-if="this.render([4])">
            <v-menu
              v-model="menuF"
              :close-on-content-click="false"
              :nudge-right="40"
              lazy
              transition="scale-transition"
              offset-y
              full-width
              min-width="290px"
            >
              <template v-slot:activator="{ on }">
                <v-text-field
                  v-model="filters.fecha"
                  label="Fecha"
                  prepend-icon="event"
                  readonly
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="filters.fecha" @input="menuF = false" locale="es-es"></v-date-picker>
            </v-menu>
          </v-flex>
        </v-layout>
      </v-layout>
    </v-card>

    <!-- vista previa -->
    <small style="color: red">*Este reporte solo es una vista previa para los datos</small>
    <div v-html="html"></div>
    <!-- /vista previa -->
  </div>
</template>

<script>
// import axios from 'axios'

export default {
  props: {
    report: {
      type: Object,
      required: true
    }
  },
  data ()  {
    return {
      menuF: false,
      preview: {
        show: false
      },
      html: '',
      filters: {
        fecha: ''
      }
    }
  },
  mounted ()  {
    if (this.render([3, 5])) this.loadReport()
  },
  watch: {
    'filters.fecha': function ()    {
      this.loadReport()
    }
  },
  computed: {
    url ()    {
      return baseURL + '/' + this.$props.report.downloadRoute
    }
  },
  methods: {
    loadReport ()    {
      const params = {
        fecha: this.filters.fecha
      }
      axios.get(this.report.viewRoute, { params: params }).then(res =>      {
        this.html = res.data
      })
    },
    download ()    {
      window.location.href = this.url + this.paramsToDownloadReport()
    },

    paramsToDownloadReport ()    {
      const params =
        '?fecha=' + this.filters.fecha
      return params
    },
    render (reportes)    {
      const index = reportes.findIndex(reporte => reporte === this.report.numero)
      if (index >= 0)      {
        return true
      }
      return false
    }
  }
}
</script>
