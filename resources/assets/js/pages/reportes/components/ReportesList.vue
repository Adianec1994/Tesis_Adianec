<template>
  <div class="component-wrap">
    <v-flex xs12 sm12>
      <v-container fluid grid-list-md style="padding:">
        <v-layout row wrap>
          <v-flex v-for="reporte in reportes" :key="reporte.numero" xs3>
            <v-card color="blue lighten-1">
              <v-container fluid pa-2>
                <v-layout row>
                  <v-flex xs12 align-end flexbox>
                    <span class="subtitle-1 white--text" v-text="reporte.nombre"></span>
                    <v-divider></v-divider>
                    <v-flex xs12>
                      <span class="caption white--text">Ver el Reporte</span>
                      <v-tooltip bottom>
                        <v-btn icon slot="activator" @click="previewReport(reporte)">
                          <v-icon class="white--text" dark>remove_red_eye</v-icon>
                        </v-btn>
                        <span>Ver</span>
                      </v-tooltip>
                    </v-flex>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-flex>
  </div>
</template>

<script>
// import axios from 'axios'

export default {
  data: () => ({
    reportes: [
      {
        nombre: 'UNE - PARTE DIARIO DE ACOMPAÑAMIENTO DE PAILAS DE COMBUSTIBLE DIESEL',
        numero: 3,
        viewRoute: 'api/reportes/3',
        downloadRoute: 'api/reportes/3/download'
      },
      {
        nombre: 'PARTE DE COBERTURA DE COMBUSTIBLE',
        numero: 4,
        viewRoute: 'api/reportes/4',
        downloadRoute: 'api/reportes/4/download'
      },
      {
        nombre: 'PARTE DE DISPONIBILIDAD',
        numero: 5,
        viewRoute: 'api/reportes/5',
        downloadRoute: 'api/reportes/5/downloadPDF'
      }
    ]
  }),

  mounted () {
  },

  methods: {
    previewReport (report) {
      this.$router.push({ name: 'reportes.preview', params: { report: report }})
    },
    canRender (permitedTo) {

    }

  }
}
</script>
