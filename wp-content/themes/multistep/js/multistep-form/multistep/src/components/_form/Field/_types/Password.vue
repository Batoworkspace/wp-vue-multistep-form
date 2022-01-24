<template>
  <v-col>
    <v-text-field
      :append-icon="password.show ? 'mdi-eye' : 'mdi-eye-off'"
      :name="settings.field_name"
      :id="settings.field_name"
      :type="!password.show ? 'password' : 'text'"
      :required="required"
      :rules="required ? [...emptiness, ...defaultRules] : defaultRules"
      :placeholder="settings.placeholder || ''"
      @click:append="password.show = !password.show"
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
      required: this.settings.field_required.toLowerCase() === 'required' ? true : false,

      password: {
        show: false
      }
    }
  },

  computed: {
    defaultRules () {
      return GlobalConstants.fields.password.rules || []
    },
    emptiness () {
      return GlobalConstants.fields.password.emptiness || []
    }
  }
}
</script>
