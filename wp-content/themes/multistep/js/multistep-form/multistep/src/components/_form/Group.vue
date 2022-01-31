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
        :class="`col-12 col-sm-${12 / (groupSettings.group_columns || 1)} pa-0`"
      >
        <field
          :fieldSettings="field.field"
          @raise="setFieldsData"
        />
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
      groupData: {
        key: this.groupSettings.group_name,
        fields: {}
      },

      deep: false
    }
  },

  watch: {
    deep () {
      this.raise(this.groupData)
    }
  },

  methods: {
    setFieldsData (data) {
      this.groupData.fields[data.key] = { value: data.value, required: data.required }
      this.deep = !this.deep
    },

    raise (data) {
      this.$emit('raise', data)
    }
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
