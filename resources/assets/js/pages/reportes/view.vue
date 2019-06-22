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
          v-on:click="createBackup()"
        >
          <v-icon>save</v-icon>
          Exportar a PDF
        </v-btn>
      </v-toolbar>

      <v-card>
        <v-data-table
          id="my-table"
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
      <v-card>
        <bar-chart
        v-if="loaded"
          :chartdata="chartData"
          :options="options"
        />
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import _ from 'lodash'
import axios from 'axios'
import Bar from './chart'

export default {
  components: {
    'bar-chart': Bar
  },
  data: () => ({
    headers: [
      { text: 'Provincias', value: 'Provincias', align: 'center' },
      { text: 'Existencia', value: 'Existencia', align: 'center' },
      { text: 'Horas', value: 'Horas', align: 'center' }
    ],
    colors: [
      'red',
      'blue',
      'yellow',
      'green',
      'brown',
      'orange',
      'black',
      'pink',
      'aqua'
    ],
    items: [],
    loaded: [],
    chartData: {},
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  }),

  props: {
    reportName: String,
    reportNumber: Number
  },

  mounted () {
    this.loaded = false
    axios.get(`/api/reportes/${this.reportNumber}`).then((result) => {
      this.items = result.data.data
      this.chartData = this.fillData(Object.keys(this.items[0]))
      // console.log(this.chartData)
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
  },
  methods: {
    fillData (keys, colors) {
      const labels = []
      const dataset = []
      this.items.forEach(item => {
        labels.push(item[keys[0]])
      })
      for (let i = 1; i < keys.length; i++) {
        dataset.push(this.fillDataSet(keys[i], this.colors[i]))
      }

      return {
        labels: labels,
        datasets: dataset
      }
    },
    fillDataSet (name, color) {
      name = _.toString(name)
      const data = []
      this.items.forEach(item => data.push(item[`${name}`]))

      return {
        label: name,
        backgroundColor: color,
        data: data
      }
    }
  }

}
</script>
