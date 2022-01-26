<template>
  <v-col class="ma-n3">
    <v-checkbox
      :name="settings.field_name"
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
      required: this.settings.field_required.toLowerCase() === 'required'
    }
  }
}
</script>
