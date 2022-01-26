<template>
  <v-col class="ma-n3">

    <!-- Advanced functionality comming soon -->
    <v-text-field
      v-model="fieldData"
      :name="settings.field_name"
      :id="settings.field_name"
      :required="required"
      :rules="checkRules"
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
      required: this.settings.field_required.toLowerCase() === 'required',

      fieldData: ''
    }
  },

  watch: {
    fieldData (value) {
      this.raise(value)
    }
  },

  computed: {
    defaultRules () {
      return GlobalConstants.fields.textfield.rules || []
    },
    emptiness () {
      return GlobalConstants.fields.textfield.emptiness || []
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
  },

  methods: {
    raise (data) {
      this.$emit('raise', data)
    }
  }
}
</script>
