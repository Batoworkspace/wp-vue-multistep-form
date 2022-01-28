<template>
  <v-container>
    <v-form v-model="valid" lazy-validation class="step">

      <!-- step header -->
      <v-row
        v-if="stepSettings.step_title || stepSettings.step_description"
        class="step__header py-4"
      >
        <v-col class="px-6">
          <h3 class="d-flex">
            <div
              v-if="isStepNumber.toLowerCase() === 'present'"
              class="mr-2"
            >{{ `${order}.` }}</div>
            <div v-html="stepSettings.step_title || ''" />
          </h3>
          <p
            v-html="stepSettings.step_description || ''"
            class="subtitle"
          />
        </v-col>
      </v-row>

      <!-- groups list -->
      <v-row>
        <v-col
          v-for="group in stepSettings.fields_group" 
          :key="group.group.group_name"
          class="col-12 pt-8 mb-n4"
        >
          <group :groupSettings="group.group" @raise="setGroupsData" />
        </v-col>
      </v-row>

      <!-- step controls -->
      <v-row class="justify-space-between">
        <v-col v-if="!first">
          <v-btn
            depressed
            text
            class="controls-button"
            @click="goBack"
          >
            {{ stepSettings.prev_step_button_text || 'Previous step' }}
          </v-btn>
        </v-col>
        <v-col v-if="!last" class="d-flex justify-end">
          <v-btn
            depressed
            text
            :disabled="!checkValid"
            class="controls-button"
            @click="goForward"
          >
            {{ stepSettings.next_step_button_text || 'Next step' }}
          </v-btn>
        </v-col>
        <v-col v-if="last" class="d-flex justify-end">
          <v-btn
            depressed
            :disabled="!isSubmit"
            color="#00ADB5"
            class="controls-button submit-button"
            @click="raiseSubmit"
          >
            {{ submitButton || 'Submit' }}
          </v-btn>
        </v-col>
      </v-row>
    </v-form>
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
    first: {
      type: Boolean
    },
    last: {
      type: Boolean
    },
    submitButton: {
      type: String
    },
    isSubmit: {
      type: Boolean
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
      valid: true,
      checkValid: false,

      stepData: {
        key: this.stepSettings.step_name,
        groups: {}
      },

      deep: false
    }
  },

  watch: {
    deep () {
      const fields = []
      Object.keys(this.stepData.groups).forEach(group => {
        const groupFields = this.stepData.groups[group]

        Object.values(groupFields).forEach(field => {
          fields.push(field)
        })
      })

      const isRequiredEmpty = fields.some(field => (field.value === null || field.value === '') && field.required)
      if (this.valid && !isRequiredEmpty) {
        this.checkValid = true
      } else {
        this.checkValid = false
      }

      if (this.checkValid) {
        this.raise(this.stepData)
      } else {
        this.drop(this.stepData)
      }
    }
  },

  methods: {
    goBack () {
      this.$emit('goBack')
    },
    goForward () {
      this.$emit('goForward')
    },

    setGroupsData (data) {
      this.stepData.groups[data.key] = data.fields
      this.deep = !this.deep

      const fields = []
      Object.keys(this.stepData.groups).forEach(group => {
        const groupFields = this.stepData.groups[group]

        Object.values(groupFields).forEach(field => {
          fields.push(field)
        })
      })

      const isRequiredEmpty = fields.some(field => (field.value === null || field.value === '') && field.required)
      if (this.valid && !isRequiredEmpty) {
        this.checkValid = true
      } else {
        this.checkValid = false
      }

      if (this.checkValid) {
        this.raise(this.stepData)
      }
    },

    raise (data) {
      this.$emit('raise', data)
    },

    drop (data) {
      this.$emit('drop', data)
    },

    raiseSubmit () {
      this.$emit('submit')
    }
  }
}
</script>

<style lang="scss" scoped>
  .step {
    &__header {
      background-color: $light_grey;

      .subtitle {
        margin: 2px 0 0;
      }
    }

    .controls-button {
      background-color: $light_grey;
      padding: 24px 42px !important;
      border-radius: 0 !important;

      &.submit-button {
        color: $soft_white;
        box-shadow: 0 0 16px rgb(0 111 117 / 40%);
      }
    }
  }
</style>
