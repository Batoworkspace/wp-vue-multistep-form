<template>
  <v-col class="ma-n3">
    <v-select
      v-model="selection"
      :items="selectItems"
      outlined
      class="mt-4"
      :required="required"
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
      
      selection: this.settings.select_default || this.selectItems[0] || ''
    }
  },

  watch: {
    selection (value) {
      this.raise(value)
    }
  },

  computed: {
    selectItems () {
      return this.settings.select_items.split(', ')
    }
  },

  mounted () {
    this.raise(this.selection)
  },

  methods: {
    raise (data) {
      this.$emit('raise', data)
    }
  }
}
</script>
