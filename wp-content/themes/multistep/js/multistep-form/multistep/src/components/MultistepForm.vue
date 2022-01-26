<template>
  <v-form v-model="valid" lazy-validation class="multistep__form">
    <v-container>

      <!-- form header -->
      <v-row
        v-if="pureSettings.form_title || pureSettings.form_subtitle"
        class="multistep__form_header"
      >
        <v-col>
          <v-container>
            <v-row class="align-center">
              <v-col class="col-12 col-md-9">
                <h2 v-html="pureSettings.form_title || ''" />
                <p
                  v-html="pureSettings.form_subtitle || ''"
                  class="subtitle"
                />
              </v-col>
              <v-col class="col-12 col-md-3 d-flex justify-end">
                <div
                  v-if="pureSettings.form_display.progress_bar.toLowerCase() === 'present'"
                  class="steps-counter"
                >
                  {{ currentStep }} / {{ stepsAmount }}
                </div>
              </v-col>
            </v-row>
          </v-container>
        </v-col>
      </v-row>

      <!-- form content -->
      <v-row class="align-start">
        <v-col
          v-show="currentStep === index + 1" v-for="(step, index) in pureSettings.steps"
          :key="index"
          :class="[{ 'horizontal-separator': pureSettings.form_description }, { 'pb-8': pureSettings.form_description }]"
        >
          <step
            :stepSettings="step.step"
            :order="index + 1"
            :first="index === 0"
            :last="!((index + 1) < pureSettings.steps.length)"
            :submitButton="pureSettings.submit_button_text"
            :isStepNumber="pureSettings.form_display.step_number"
            @goBack="setStep(index)"
            @goForward="setStep(index + 2)"
          />
        </v-col>
      </v-row>
      <v-row v-if="pureSettings.form_description">
        <v-col>
          <div
            v-html="pureSettings.form_description || ''"
            class="px-6 pb-4 pt-8 multistep__form_description"
          />
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
      valid: true,

      currentStep: 1
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
    },

    stepsAmount () {
      return this.pureSettings.steps.length
    }
  },

  methods: {
    setStep (step) {
      this.currentStep = step
    }
  }
}
</script>

<style lang="scss" scoped>
  .multistep__form {
    &_header {
      background-color: $dark_blue;
      color: $soft_white;

      .steps-counter {
        font-size: 1.4rem;
        font-weight: 600;
        background: $soft_white;
        padding: 8px 16px;
        border-radius: 32px;
        color: $dark_blue;
      }

      .subtitle {
        margin: 2px 0 0;
        font-weight: 300;
      }
    }
  }

  .horizontal-separator {
    border-bottom: solid 1px #eee;
  }
</style>
