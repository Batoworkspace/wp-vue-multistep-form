<template>
  <v-form v-model="valid" lazy-validation>
    <v-container>
      <v-row v-if="pureSettings.form_title || pureSettings.form_subtitle">
        <v-col>
          <h2 v-html="pureSettings.form_title || ''" />
          <p v-html="pureSettings.form_subtitle || ''" />
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-container>
            <v-row v-for="(step, index) in pureSettings.steps" :key="index">
              <v-col>
                <step
                  :stepSettings="step.step"
                  :order="index + 1"
                  :last="!((index + 1) < pureSettings.steps.length)"
                  :submitButton="pureSettings.submit_button_text"
                  :isStepNumber="pureSettings.form_display.step_number"
                />
              </v-col>
            </v-row>
          </v-container>
        </v-col>
      </v-row>
      <v-row v-if="pureSettings.form_description">
        <v-col>
          <p v-html="pureSettings.form_description || ''" />
        </v-col>
      </v-row>
    </v-container>
  </v-form>
</template>

<script>
import Step from './_form/Step'

export default {
  props: {
    settings: {
      type: Object
    }
  },

  components: {
    Step
  },

  data () {
    return {
      valid: true
    }
  },

  computed: {
    pureSettings () {
      if (this.settings) {
        const data = this.settings.data || {}

        if (data) {
          return data
        }

        return {}
      }

      return {}
    }
  }
}
</script>
