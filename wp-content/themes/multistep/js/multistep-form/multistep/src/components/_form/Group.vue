<template>
  <v-container class="group">
    <v-row v-if="groupSettings.group_label">
      <v-col class="pa-0 pb-1">
        <label class="group__label">{{ groupSettings.group_label }}</label>
      </v-col>
    </v-row>
    <v-row class="mr-n9">
      <v-col
        v-for="field in groupSettings.fields"
        :key="field.field.field_name"
        :class="`col-${12 / (groupSettings.group_columns || 1)} pa-0`"
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
  }
}
</script>

<style lang="scss" scoped>
  .group {
    &__label {
      font-weight: 600;
    }
  }
</style>
