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
        <v-toolbar-title>{{reportName}}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn
          dark
          color="primary"
          class="mb-2"
          v-on:click="pdfExport(items)"
        >
          <v-icon>save</v-icon>
          Exportar a PDF
        </v-btn>
      </v-toolbar>

      <v-card>
        <v-data-table
          :items="items"
          :headers="headers"
        >
          <template v-slot:items="props">
            <td class="text-xs-center justify-center">{{ props.item.Provincias }}</td>
            <td class="text-xs-center justify-center">{{ props.item.Existencia }}</td>
            <td class="text-xs-center justify-center">{{ props.item.Horas }}</td>
          </template>
        </v-data-table>
      </v-card>
      <report-view
        v-if="loaded"
        :items="items"
        @chart="chart = $event"
      ></report-view>
    </v-flex>
  </v-layout>
</template>

<script>
import axios from 'axios'
import ReportView from './view'
import PdfExport from '../../common/PdfExport.js'

export default {
  mixins: [PdfExport],
  data: () => ({
    loaded: false,
    items: [],
    headers: [
      { text: 'Provincias', value: 'Provincias', align: 'center' },
      { text: 'Existencia', value: 'Existencia', align: 'center' },
      { text: 'Horas', value: 'Horas', align: 'center' }
    ],
    reportName: 'Existencia de Lubricantes',
    reportNumber: 8
  }),

  components: {
    'report-view': ReportView
  },
  mounted () {
    this.loaded = false
    axios.get(`/api/reportes/${this.reportNumber}`).then((result) => {
      this.items = result.data.data
      this.loaded = true
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
  }
}
</script>
