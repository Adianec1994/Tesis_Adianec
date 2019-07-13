import pdfMake from 'pdfmake/build/pdfmake'
import pdfFonts from 'pdfmake/build/vfs_fonts'
pdfMake.vfs = pdfFonts.pdfMake.vfs

export default {
  methods: {
    pdfExport (items) {
      const colsHeaders = this.extractHeaders(Object.keys(items[0]))
      const rows = this.extractValues(items)
      const chartImage = this.extractImage()
      rows.unshift(colsHeaders)

      const docDefinition = {
        content: [
          {
            text: this.reportName,
            style: 'header'
          },
          {
            margin: 5,
            table: {
              headerRows: 1,
              body: rows
            }
          },
          {
            image: chartImage,
            width: 480,
            height: 200,
            margin: 5
          }
        ],
        styles: {
          header: {
            fontSize: 18,
            bold: true,
            alignment: 'center',
            margin: 5
          },
          tableHeader: {
            bold: true,
            alignment: 'center'
          },
          tableBody: {
            alignment: 'center'
          }
        }
      }
      // console.log(rows)

      pdfMake.createPdf(docDefinition).download(this.reportName)
    },

    extractHeaders (headers) {
      return headers.map(header => {
        return {
          text: header,
          style: 'tableHeader'
        }
      })
    },

    extractValues (items) {
      const values = []
      items.forEach(item => {
        values.push(Object.values(item))
      })
      return this.stylingValues(values)
    },

    stylingValues (rows) {
      return rows.map(row => this.stylingRow(row))
    },

    stylingRow (row) {
      return row.map(value => {
        return {
          text: value,
          style: 'tableBody'
        }
      })
    },

    extractImage () {
      return this.$data.chart.toBase64Image()
    }
  }
}
