import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import VueFormGenerator from 'vue-form-generator'
import 'vue-form-generator/dist/vfg.css'
import store from '~/store'
import router from '~/router'
import { i18n } from '~/plugins'
import App from '~/components/App'
import '~/components'

Vue.use(Vuetify)
Vue.use(VueFormGenerator)

Vue.config.productionTip = false

new Vue({
  el: '#app',
  i18n,
  store,
  router,
  ...App
})
