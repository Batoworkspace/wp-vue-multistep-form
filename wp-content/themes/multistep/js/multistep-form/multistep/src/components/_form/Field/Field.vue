<template>
  <v-container class="pt-7">
    <v-row>
      <v-col class="pa-0">
        <label v-if="fieldSettings.field_label" :for="fieldSettings.field_name">
          {{ fieldSettings.field_label || '' }}<sup v-if="requiredMark">*</sup>
        </label>
        <v-container>
          <v-row>
            <component
              :is="fieldSettings.field_type.toLowerCase().replace(/\s/g, '')"
              :settings="fieldSettings"
              @raise="setFieldData"
            />
          </v-row>
        </v-container>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Textfield from './_types/Textfield'
import Textrows from './_types/Textrows'
import Email from './_types/Email'
import Number from './_types/Number'
import Password from './_types/Password'
import Checkbox from './_types/Checkbox'
import Selection from './_types/Selection'
import Radiogroup from './_types/Radiogroup'
import Slider from './_types/Slider'
import Date from './_types/Date'

export default {
  props: {
    fieldSettings: {
      type: Object
    }
  },

  components: {
    Textfield,
    Textrows,
    Email,
    Number,
    Password,
    Checkbox,
    Selection,
    Radiogroup,
    Slider,
    Date
  },

  data () {
    return {
      fieldData: {
        key: this.fieldSettings.field_name,
        value: null,
        required: this.fieldSettings.field_required.toLowerCase() === 'required'
      }
    }
  },

  watch: {
    'fieldData.value' () {
      this.raise(this.fieldData)
    }
  },

  computed: {
    requiredMark () {
      if (this.fieldSettings.field_required.toLowerCase() === 'required') {
        const notBeingMarked = [
          'checkbox',
          'radiogroup',
          'selection',
          'slider'
        ]

        if (notBeingMarked.some(type => type === this.fieldSettings.field_type.toLowerCase().replace(/\s/g, ''))) {
          return false
        }

        if (this.fieldSettings.field_type.toLowerCase().replace(/\s/g, '') === 'number') {
          if (this.fieldSettings.number_field_type.toLowerCase() === 'counter') {
            return false
          }
        }

        return true
      }

      return false
    }
  },

  methods: {
    setFieldData (data) {
      this.fieldData.value = data
    },

    raise (data) {
      this.$emit('raise', data)
    }
  }
}
</script>

<style lang="scss" scoped>
  label sup {
    color: #ff5252;
  }
</style>
