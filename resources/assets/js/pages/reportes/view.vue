<template>
  <v-card>
    <bar-chart
    v-if="loaded"
      :chartdata="chartData"
      :options="options"
      v-on:chart="onChartEvent"
    />
  </v-card>
</template>

<script>
import _ from 'lodash'
import Bar from './chart'

export default {
  components: {
    'bar-chart': Bar
  },
  data: () => ({
    loaded: false,
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
    items: Array
  },

  mounted () {
    this.loaded = false
    this.chartData = this.fillData(Object.keys(this.items[0]))
    this.loaded = true
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
    },
    onChartEvent (chart) {
      this.$emit('chart', chart)
    }
  }

}
</script>
