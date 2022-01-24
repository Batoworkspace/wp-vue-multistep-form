<template>
  <v-col>
    <v-select
      v-model="selection"
      :items="selectItems"
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
