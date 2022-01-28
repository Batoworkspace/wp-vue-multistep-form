<template>
  <v-col>
    <div class="slider-value mb-1 ml-n3">{{ slider }}</div>
    <v-slider
      v-model="slider"
      :min="settings.slider_min_value || 0"
      :max="settings.slider_max_value || 1"
      :ticks="settings.slider_ticks.toLowerCase() === 'allow' ? 'always' : false"
      tick-size="6"
      :step="settings.slider_step || 1"
      class="ml-n3"
      color="#393E46"
      track-color="#B4C4DE"
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

      slider: this.settings.slider_min_value || 0
    }
  },

  watch: {
    slider (value) {
      this.raise(value)
    }
  },

  mounted () {
    this.raise(this.slider)
  },

  methods: {
    raise (data) {
      this.$emit('raise', data)
    }
  }
}
</script>

<style lang="scss" scoped>
  .slider-value {
    text-align: center;
    font-size: 1.25rem;
    font-weight: 700;
    color: $dark_grey;
  }
</style>
