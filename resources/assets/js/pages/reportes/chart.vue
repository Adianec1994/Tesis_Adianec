<script>
import { Bar } from 'vue-chartjs'

export default {
  extends: Bar,
  props: {
    chartdata: {
      type: Object,
      required: true
    },
    options: {
      type: Object,
      required: true
    }
  },
  mounted () {
    this.renderChart(this.chartdata, this.options)
  }
}
</script>
