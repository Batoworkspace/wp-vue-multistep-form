<template>
  <v-col class="ma-n3">
    <v-text-field
      :append-icon="password.show ? 'mdi-eye' : 'mdi-eye-off'"
      :name="settings.field_name"
      :id="settings.field_name"
      :type="!password.show ? 'password' : 'text'"
      :required="required"
      :rules="checkRules"
      :placeholder="settings.placeholder || ''"
      outlined
      class="mt-4"
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
      required: this.settings.field_required.toLowerCase() === 'required',

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
    },
    checkRules () {
      if (this.required) {
        if (!this.settings.minimum_length && !this.settings.maximum_length) {
          return [...this.emptiness, ...this.defaultRules]
        }

        if (this.settings.minimum_length && !this.settings.maximum_length) {
          return [...this.emptiness, v => !!v && v.length >= this.settings.minimum_length || `Should be more than ${this.settings.minimum_length} characters`]
        }

        if (!this.settings.minimum_length && this.settings.maximum_length) {
          return [...this.emptiness, v => !!v && v.length <= this.settings.maximum_length || `Should be less than ${this.settings.maximum_length} characters`]
        }

        if (this.settings.minimum_length && this.settings.maximum_length) {
          return [
            ...this.emptiness,
            v => !!v && v.length >= this.settings.minimum_length || `Should be at least ${this.settings.minimum_length} characters long`,
            v => !!v && v.length <= this.settings.maximum_length || `Should be not more than ${this.settings.maximum_length} characters long`
          ]
        }
      }

      return this.defaultRules
    }
  }
}
</script>
