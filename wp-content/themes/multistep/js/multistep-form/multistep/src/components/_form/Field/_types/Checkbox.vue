<template>
  <v-col class="ma-n3">
    <v-checkbox
      v-model="checkbox"
      :name="settings.field_name"
      :required="required"
      :id="settings.field_name"
      :label="settings.checkbox_label || ''"
      color="#00ADB5"
    />
  </v-col>
</template>

<script>
export default {
  props: {
    settings: {
      type: Object
    }
  },

  data () {
    return {
      required: this.settings.field_required.toLowerCase() === 'required',

      checkbox: false
    }
  },

  watch: {
    checkbox (value) {
      this.raise(value)
    }
  },

  mounted () {
    this.raise(this.checkbox)
  },

  methods: {
    raise (data) {
      this.$emit('raise', data)
    }
  }
}
</script>
