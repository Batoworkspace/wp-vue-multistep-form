<template>
  <v-col class="ma-n3">
    <v-radio-group
      :column="settings.radio_grid.toLowerCase() === 'column'"
      :row="settings.radio_grid.toLowerCase() === 'row'"
    >
      <v-radio
        v-for="radio in settings.radio_items"
        :key="radio.radio_button_value"
        :label="radio.radio_button_label"
        :value="radio.radio_button_value"
      />
    </v-radio-group>
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
