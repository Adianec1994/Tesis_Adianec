import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import VueFormGenerator from 'vue-form-generator'
import _ from 'lodash'
import 'vue-form-generator/dist/vfg.css'
import store from '~/store'
import router from '~/router'
import {
  i18n
} from '~/plugins'
import App from '~/components/App'
import '~/components'

Vue.use(Vuetify)
Vue.use(VueFormGenerator, {
  validators: {
    msg: (text, ...arr) => {
      if (text != null && arr.length > 0) {
        for (let i = 0; i < arr.length; i++) {
          text = text.replace('{' + (i) + '}', arr[i])
        }
        return text
      }
    },
    checkEmpty: (value, required, messages = VueFormGenerator.validators.resources) => {
      if (_.isNil(value) || value === '') {
        if (required) {
          return [messages.fieldIsRequired]
        } else {
          return []
        }
      }
      return null
    },
    integer: (value, field, model, messages = VueFormGenerator.validators.resources) => {
      const res = VueFormGenerator.validators.checkEmpty(value, field.required, messages)
      if (res != null) return res

      value = _.isNaN(_.toNumber(value)) ? value : _.toNumber(value)
      const errs = VueFormGenerator.validators.number(value, field, model, messages)

      if (!_.isInteger(value)) {
        errs.push(VueFormGenerator.validators.msg(messages.invalidInteger))
      }

      return errs
    },
    double (value, field, model, messages = VueFormGenerator.validators.resources) {
      const res = VueFormGenerator.validators.checkEmpty(value, field.required, messages)
      if (res != null) return res

      const errs = []
      if (field.max) {
        const aux = _.split(value, '.')
        if (aux[1] && _.size(aux[1]) > field.max) {
          errs.push(VueFormGenerator.validators.msg(messages.afterCommaTooBig, field.max))
        }
      }

      value = _.isNaN(_.toNumber(value)) ? value : _.toNumber(value)

      if (!_.isNumber(value) || isNaN(value)) {
        errs.push(VueFormGenerator.validators.msg(messages.invalidNumber))
      }

      return errs
    },
    nombre (value, field, model, messages = VueFormGenerator.validators.resources) {
      const res = VueFormGenerator.validators.checkEmpty(value, field.required, messages)
      if (res != null) return res

      const re = /^[a-zA-Z][a-zA-Z|\s]*$/
      if (!re.test(value)) {
        return [messages.invalidTextContainNumber]
      }
    },
    email (value, field, model, messages = VueFormGenerator.validators.resources) {
      const res = VueFormGenerator.validators.checkEmpty(value, field.required, messages)
      if (res != null) return res

      const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ // eslint-disable-line no-useless-escape
      if (!re.test(value)) {
        return [messages.invalidEmail]
      }
    },
    fecha (value, field, model, messages = VueFormGenerator.validators.resources) {
      return VueFormGenerator.validators.date(value, field, model, messages)
    }
  }
})
Vue.use(_)

VueFormGenerator.validators.resources = {
  fieldIsRequired: 'Este campo es requerido!',
  invalidFormat: 'Formato inválido!',

  numberTooSmall: 'El número es muy pequeño! Mínimo: {0}',
  numberTooBig: 'El número es muy grande! Máximo: {0}',
  invalidNumber: 'Número inválido',
  invalidInteger: 'El valor no es un entero',
  afterCommaTooBig: 'Solo debe tener {0} número después de la coma',

  textTooSmall: 'La longitud del texto es muy pequeña! Actual: {0}, Mínimo: {1}',
  textTooBig: 'La longitud del texto es muy grande! Actual: {0}, Máximo: {1}',
  thisNotText: 'This is not a text!',

  thisNotArray: 'Esto no es un arreglo!',

  selectMinItems: 'Selecciona como mínimo {0} elementos!',
  selectMaxItems: 'Selecciona como máximo {0} elementos!',

  invalidDate: 'Fecha inválida!',
  dateIsEarly: 'La fecha es muy antigua! Actual: {0}, Mínimo: {1}',
  dateIsLate: 'La fecha es muy posterior! Actual: {0}, Máximo: {1}',

  invalidEmail: 'Dirección de correo inválida!',
  invalidURL: 'URL inválida!',

  invalidCard: 'Formato de tarjeta inválido!',
  invalidCardNumber: 'Número de tarjeta inválido!',

  invalidTextContainNumber: 'Texto inválido! No puede contener números o caracteres especiales',
  invalidTextContainSpec: 'Texto inválido! No puede contener caracteres especiales'
}

Vue.config.productionTip = false

new Vue({
  el: '#app',
  i18n,
  store,
  router,
  ...App
})
