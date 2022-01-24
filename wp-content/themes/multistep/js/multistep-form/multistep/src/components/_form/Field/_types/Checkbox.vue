<template>
  <v-col>
    <v-checkbox
      :name="settings.field_name"
      :id="settings.field_name"
      :label="settings.checkbox_label || ''"
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
      required: this.settings.field_required.toLowerCase() === 'required' ? true : false
    }
  }
}
</script>
