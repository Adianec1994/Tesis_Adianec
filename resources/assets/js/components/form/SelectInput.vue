<template>
  <div>
    <v-select
      :items="items"
      :class="errorClass"
      :error-messages="errorMessages"
      :hint="hint"
      :label="label"
      :name="name"
      :itemText="itemText"
      :itemValue="itemValue"
      v-model="_value"
    ></v-select>
    <has-error
      :form="form"
      :field="name"
    ></has-error>
  </div>
</template>

<script>
import TextInput from './TextInput'

export default {
  extends: TextInput,
  name: 'select-input',

  props: {
    items: {
      type: Array,
      required: true
    },
    itemText: {
      type: String,
      required: true
    },
    itemValue: {
      type: String,
      required: true
    }
  },

  computed: {
    _value: {
      get () {
        return this.value
      },
      set (value) {
        value = value || ''
        this.$emit('update:value', value)
        this.$emit('input', value)
      }
    }
  }
}
</script>
