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
          <v-flex xs12 sm4 class="px-2" v-if="this.render([22 , 23 , 24])">
            <v-checkbox label="Escuela" v-model="filters.checkbox_escuela" value="1"></v-checkbox>
          </v-flex>
          <v-flex xs12 sm4 class="px-2" v-if="this.render([22 , 23, 24])">
            <v-checkbox label="Departamento" v-model="filters.checkbox_departamento" value="1"></v-checkbox>
          </v-flex>
          <v-flex xs12 sm4 class="px-2" v-if="this.render([22])">
            <v-checkbox label="Especialidad" v-model="filters.checkbox_especialidad" value="1"></v-checkbox>
          </v-flex>
          <v-flex xs12 sm4 class="px-2" v-if="this.render([22, 24])">
            <v-checkbox label="Profesor" v-model="filters.checkbox_profesor" value="1"></v-checkbox>
          </v-flex>
          <v-flex xs12 sm4 class="px-2" v-if="this.render([22 , 23 , 24])">
            <v-checkbox label="Asignatura" v-model="filters.checkbox_asignatura" value="1"></v-checkbox>
          </v-flex>
          <v-flex xs12 sm4 class="px-2" v-if="this.render([201 , 202 , 203 , 204,205])">
            <v-select
              :items="selects.cursos"
              v-model="filters.curso"
              label="Curso"
              item-text="nombre"
              item-value="id"
            ></v-select>
          </v-flex>
          <v-flex xs12 sm4 class="px-2" v-if="this.render([201 , 202 , 204,205])">
            <v-select
              :items="selects.asignaturas"
              v-model="filters.asignatura"
              label="Asignatura"
              item-text="nombre"
              item-value="id"
            ></v-select>
          </v-flex>
          <v-flex xs12 sm4 class="px-2" v-if="this.render([201 , 202 , 203 , 204, 205])">
            <v-select
              :items="selects.grupos"
              v-model="filters.grupo"
              label="Grupo"
              item-text="nombre"
              item-value="id"
            ></v-select>
          </v-flex>
          <v-flex xs12 sm4 class="px-2" v-if="this.render([29, 28])">
            <v-menu
              v-model="menuFI"
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
                  v-model="filters.fechaInicio"
                  label="Fecha inicio"
                  prepend-icon="event"
                  readonly
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="filters.fechaInicio" @input="menuFI = false" locale="es-es"></v-date-picker>
            </v-menu>
          </v-flex>
          <v-flex xs12 sm4 class="px-2" v-if="this.render([29, 28])">
            <v-menu
              v-model="menuFF"
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
                  v-model="filters.fechaFin"
                  label="Fecha fin"
                  prepend-icon="event"
                  readonly
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="filters.fechaFin" @input="menuFF = false" locale="es-es"></v-date-picker>
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
      menuFI: false,
      menuFF: false,
      preview: {
        show: false
      },
      html: '',
      filters: {
        checkbox_escuela: '',
        checkbox_especialidad: '',
        checkbox_asignatura: '',
        checkbox_profesor: '',
        checkbox_departamento: '',
        curso: '',
        asignatura: '',
        fechaInicio: '',
        fechaFin: '',
        grupo: '',
        aula: ''
      },
      selects: {
        cursos: [],
        asignaturas: [],
        grupos: []
      }
    }
  },
  mounted ()  {
    this.loadReport()
  },
  computed: {
    url ()    {
      return baseURL + '/' + this.$props.report.downloadRoute
    }
  },
  methods: {
    loadReport ()    {
      axios.get(this.report.viewRoute).then(res =>      {
        this.html = res.data
      })
    },
    download ()    {
      window.location.href = this.url
    },

    paramsToDownloadReport ()    {
      const params =
        '?checkbox_escuela=' + this.filters.checkbox_escuela +
        '&checkbox_departamento=' + this.filters.checkbox_departamento +
        '&checkbox_especialidad=' + this.filters.checkbox_especialidad +
        '&checkbox_asignatura=' + this.filters.checkbox_asignatura +
        '&checkbox_profesor=' + this.filters.checkbox_profesor +
        '&fechaInicio=' + this.filters.fechaInicio +
        '&fechaFin=' + this.filters.fechaFin +
        '&grupo=' + this.filters.grupo +
        '&asignatura=' + this.filters.asignatura +
        '&curso=' + this.filters.curso
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
