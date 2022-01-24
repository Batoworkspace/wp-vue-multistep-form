<template>
  <v-col>
    <!-- 'Regular' number field -->
    <v-text-field
      v-if="settings.number_field_type.toLowerCase() === 'regular'"
      :name="settings.field_name"
      :id="settings.field_name"
      :type="settings.telephone.toLowerCase() === 'yes' ? 'tel' : 'number'"
      pattern="[0-9]*"
      inputmode="numeric"
      :required="required"
      :rules="required ? [...emptiness, ...defaultRules] : defaultRules"
      :placeholder="settings.placeholder || ''"
    />

    <!-- 'PIN' number field -->
    <div
      v-if="settings.number_field_type.toLowerCase() === 'pin'"
      class="d-flex"
    >
      <input
        v-for="char in pinCharsAmount"
        :key="char"
        type="number"
        pattern="[0-9]*"
        inputmode="numeric"
        maxlength="1"
        placeholder="*"
        :required="required"
        v-model="pin.items[char - 1]"
        :ref="`pinItem_${char - 1}`"
        @input="handlePinInput($event, char - 1, pinCharsAmount)"
        @keyup="handlePinKeyup($event, char - 1, pinCharsAmount)"
        @keyup.delete="handlePinDelete($event, char - 1)"
      />
    </div>

    <!-- 'Counter' number field -->
    <div
      v-if="settings.number_field_type.toLowerCase() === 'counter'"
      class="d-flex"
    >
      <v-btn
        :disabled="counter === counterMinValue"
        @click="counterMinus(counter, counterMinValue)"
      >
        M
      </v-btn>
      <v-text-field
        type="number"
        pattern="[0-9]*"
        inputmode="numeric"
        :required="required"
        disabled
        v-model="counter"
      />
      <v-btn
        :disabled="counter === counterMaxValue"
        @click="counterPlus(counter, counterMaxValue)"
      >
        P
      </v-btn>
    </div>
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
      required: this.settings.field_required.toLowerCase() === 'required' ? true : false,

      pin: {
        items: []
      },

      counter: Number.parseInt(this.settings.counter_min_value) || 0
    }
  },

  computed: {
    defaultRules () {
      return GlobalConstants.fields.number.rules || []
    },
    emptiness () {
      return GlobalConstants.fields.number.emptiness || []
    },

    pinCharsAmount () {
      return Number.parseInt(this.settings.characters_amount) || 6
    },

    counterMinValue () {
      return Number.parseInt(this.settings.counter_min_value) || 0
    },
    counterMaxValue () {
      return Number.parseInt(this.settings.counter_max_value) || 12
    }
  },

  methods: {
    handlePinInput (event, index, amount) {
      const inputs = []

      for (let i = 0; i < amount; i++) {
        const input = this.$refs[`pinItem_${i}`]

        inputs.push(input)
      }

      event.target.value = event.data
      this.pin.items[index] = event.data
    },

    handlePinKeyup (event, index, amount) {
      if (event.keyCode !== 8 && event.keyCode !== 46) {
        if (index < amount - 1) {
          const nextInput = this.$refs[`pinItem_${index + 1}`][0]

          if (event.target.value) {
            nextInput.focus()
          }
        }
      }
    },

    handlePinDelete (event, index) {
      if (index > 0) {
        const prevInput = this.$refs[`pinItem_${index - 1}`][0]

        if (!event.target.value && !this.pin.items[index]) {
          prevInput.focus()
        }
      }
    },

    counterMinus (value, min) {
      if (value > min) {
        this.counter = value - 1
      }
    },

    counterPlus (value, max) {
      if (value < max) {
        this.counter = value + 1
      }
    }
  }
}
</script>
