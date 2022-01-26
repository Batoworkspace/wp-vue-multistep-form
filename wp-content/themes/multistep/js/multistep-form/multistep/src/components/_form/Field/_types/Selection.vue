<template>
  <v-col class="ma-n3">
    <v-select
      v-model="selection"
      :items="selectItems"
      outlined
      class="mt-4"
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

  computed: {
    selectItems () {
      return this.settings.select_items.split(', ')
    }
  }
}
</script>
