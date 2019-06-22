import jsPDF from 'jspdf'
import 'jspdf-autotable'

export default {
  methods: {
    pdfExport: (items) => {
      const doc = new jsPDF()
      const cols = [Object.keys(items[0])]
      const rows = []

      items.forEach(element => {
        const temp = []
        cols.forEach(col => {
          temp.push(element[col])
        })
        rows.push(temp)
      })

      console.log(cols)

      doc.autoTable(cols, rows)
      doc.save('Test.pdf')
    }
  }
}
