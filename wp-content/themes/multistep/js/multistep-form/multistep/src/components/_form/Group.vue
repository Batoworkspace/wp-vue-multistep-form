<template>
  <v-container>
    <v-row v-if="groupSettings.group_name">
      <label>{{ groupSettings.group_name }}</label>
    </v-row>
    <v-row>
      <v-col
        v-for="field in groupSettings.fields"
        :key="field.field.field_name"
        :class="`col-${12 / (groupSettings.group_columns || 1)}`"
      >
        <field :fieldSettings="field.field" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Field from './Field/Field'

export default {
  props: {
    groupSettings: {
      type: Object
    }
  },

  components: {
    Field
  },

  data () {
    return {

    }
  }
}
</script>
