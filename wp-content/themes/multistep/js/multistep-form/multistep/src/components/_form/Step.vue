<template>
  <v-container>
    <v-row v-if="stepSettings.step_title || stepSettings.step_description">
      <v-col>
        <h3><span v-if="isStepNumber.toLowerCase() === 'present'">{{ `${order}.` }}</span><div v-html="stepSettings.step_title || ''"><h3>
        <p v-html="stepSettings.step_description || ''" />
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-container>
          <v-row v-for="group in stepSettings.fields_group" :key="group.group.group_name">
            <v-col>
              <group :groupSettings="group.group" />
            </v-col>
          </v-row>
        </v-container>
      </v-col>
    </v-row>
    <v-row v-if="!last">
      <v-col>
        <v-btn>
          {{ stepSettings.next_step_button_text || 'Next step' }}
        </v-btn>
      </v-col>
    </v-row>
    <v-row v-if="last">
      <v-col>
        <v-btn>
          {{ submitButton || 'Submit' }}
        </v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Group from './Group'

export default {
  props: {
    stepSettings: {
      type: Object
    },
    order: {
      type: Number
    },
    last: {
      type: Boolean
    },
    submitButton: {
      type: String
    },
    isStepNumber: {
      type: Number
    }
  },

  components: {
    Group
  },

  data () {
    return {
      
    }
  }
}
</script>
