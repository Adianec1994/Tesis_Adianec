<template>
  <vue-form-generator
    :schema="schema"
    :model="model"
    :options="formOptions"
  ></vue-form-generator>
</template>

<script>

export default {
  props: {
    schema: {
      type: Object,
      required: true
    },
    model: {
      type: Object,
      required: true
    },
    options: {
      type: Object
    },
    isNewModel: {
      type: Boolean
    }
  }
}
</script>
