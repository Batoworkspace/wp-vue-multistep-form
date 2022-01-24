<template>
  <v-container>
    <v-row>
      <v-col>
        <label v-if="fieldSettings.field_label" :for="fieldSettings.field_name">{{ fieldSettings.field_label || '' }}</label>
        <v-container>
          <v-row>
            <component
              :is="fieldSettings.field_type.toLowerCase().replace(/\s/g, '')"
              :settings="fieldSettings"
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
  }
}
</script>
