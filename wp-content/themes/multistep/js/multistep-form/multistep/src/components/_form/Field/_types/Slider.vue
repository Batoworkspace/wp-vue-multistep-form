<template>
  <v-col>
    {{ slider }}
    <v-slider
      v-model="slider"
      :min="settings.slider_min_value || 0"
      :max="settings.slider_max_value || 1"
      :ticks="settings.slider_ticks.toLowerCase() === 'allow' ? 'always' : false"
      tick-size="6"
      :step="settings.slider_step || 1"
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
      required: this.settings.field_required.toLowerCase() === 'required' ? true : false,

      slider: this.settings.slider_min_value || 0
    }
  }
}
</script>
