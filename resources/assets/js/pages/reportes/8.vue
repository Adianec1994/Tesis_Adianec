<template>
<div>
  <report-view
    :reportName="reportName"
    :reportNumber="reportNumber"
  ></report-view>
</div>
</template>

<script>
import ReportView from './view'

export default {
  data: () => ({
    items: [],
    reportName: 'Existencia de Lubricantes',
    reportNumber: 8
  }),

  components: {
    'report-view': ReportView
  }
}
</script>
