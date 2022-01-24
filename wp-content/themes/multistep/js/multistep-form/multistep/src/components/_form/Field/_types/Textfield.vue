<template>
  <v-col>
    <v-text-field
      :name="settings.field_name"
      :id="settings.field_name"
      :required="required"
      :rules="required ? [...emptiness, ...defaultRules] : defaultRules"
      :placeholder="settings.placeholder || ''"
    />
  </v-col>
</template>

<script>
import { GlobalConstants } from '../../../../settings/globalConstants'

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
  },

  computed: {
    defaultRules () {
      return GlobalConstants.fields.textfield.rules || []
    },
    emptiness () {
      return GlobalConstants.fields.textfield.emptiness || []
    }
  }
}
</script>
