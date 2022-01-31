<template>
  <v-col class="ma-n3">

    <!-- 'Regular' number field -->
    <v-text-field
      v-if="settings.number_field_type.toLowerCase() === 'regular'"
      v-model="fieldData"
      :name="settings.field_name"
      :id="settings.field_name"
      :type="settings.telephone.toLowerCase() === 'yes' ? 'tel' : 'number'"
      pattern="[0-9]*"
      inputmode="numeric"
      :required="required"
      :rules="!required ? [...checkRules] : [...checkRules, ...emptiness]"
      :placeholder="settings.placeholder || ''"
      outlined
      class="mt-4"
    />

    <!-- 'PIN' number field -->
    <div
      v-if="settings.number_field_type.toLowerCase() === 'pin'"
      class="d-flex justify-space-between mt-4 mb-2 number-pin"
    >
      <input
        v-for="char in pinCharsAmount"
        :key="char"
        type="number"
        pattern="[0-9]*"
        inputmode="numeric"
        maxlength="1"
        placeholder="•"
        :required="required"
        v-model="pin.items[char - 1]"
        :ref="`pinItem_${char - 1}`"
        @input="handlePinInput($event, char - 1, pinCharsAmount)"
        @keyup="handlePinKeyup($event, char - 1, pinCharsAmount)"
        @keyup.delete="handlePinDelete($event, char - 1)"
        :style="`width: calc(100% / ${pinCharsAmount} - 8px);`"
      />
    </div>

    <!-- 'Counter' number field -->
    <div
      v-if="settings.number_field_type.toLowerCase() === 'counter'"
      class="d-flex mt-4 number-counter"
    >
      <v-btn
        depressed
        :disabled="counter === counterMinValue"
        @click="counterMinus(counter, counterMinValue)"
        class="number-counter__button minus mr-2"
      />
      <v-text-field
        type="number"
        pattern="[0-9]*"
        inputmode="numeric"
        :required="required"
        disabled
        outlined
        v-model="counter"
        class="number-counter__field"
      />
      <v-btn
        depressed
        :disabled="counter === counterMaxValue"
        @click="counterPlus(counter, counterMaxValue)"
        class="number-counter__button plus ml-2"
      />
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
      required: this.settings.field_required.toLowerCase() === 'required',

      fieldData: '',

      pin: {
        items: []
      },

      counter: Number.parseInt(this.settings.counter_min_value) || 0
    }
  },

  watch: {
    fieldData (value) {
      this.raise(value)
    },

    pin: {
      deep: true,

      handler (value) {
        const isPinFilled = value.items && value.items.length === this.pinCharsAmount && !value.items.some(item => item === '' || item === null)
        this.raise(isPinFilled ? value.items.join('') : '')
      }
    },

    counter (value) {
      this.raise(value)
    }
  },

  computed: {
    defaultRules () {
      return GlobalConstants.fields.number.rules || []
    },
    emptiness () {
      return GlobalConstants.fields.number.emptiness || []
    },
    checkRules () {
      if (this.fieldData) {
        if (!this.settings.minimum_length && !this.settings.maximum_length) {
          return [...this.defaultRules]
        }

        if (this.settings.minimum_length && !this.settings.maximum_length) {
          return [v => !!v && v.length >= this.settings.minimum_length || `Should be more than ${this.settings.minimum_length} characters`]
        }

        if (!this.settings.minimum_length && this.settings.maximum_length) {
          return [v => !!v && v.length <= this.settings.maximum_length || `Should be less than ${this.settings.maximum_length} characters`]
        }

        if (this.settings.minimum_length && this.settings.maximum_length) {
          return [
            v => !!v && v.length >= this.settings.minimum_length || `Should be at least ${this.settings.minimum_length} characters long`,
            v => !!v && v.length <= this.settings.maximum_length || `Should be not more than ${this.settings.maximum_length} characters long`
          ]
        }

        return this.defaultRules
      }

      return []
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

  mounted () {
    if (this.settings.number_field_type.toLowerCase() === 'regular') {
      this.raise(this.fieldData)
    } else if (this.settings.number_field_type.toLowerCase() === 'pin') {
      this.raise(this.pin.items.join(''))
    } else {
      this.raise(this.counter)
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
    },

    raise (data) {
      this.$emit('raise', data)
    }
  }
}
</script>

<style lang="scss" scoped>
  .number-pin {
    max-width: 50%;

    @include media($md, max-width, 70%);

    @include media($sm, max-width, 100%);

    input {
      padding: 8px 6px;
      text-align: center;
      background-color: $light_grey;
      border: solid 2px $light_grey;
      border-radius: 4px;

      &:focus {
        border: solid 2px $dark_grey;
      }
    }
  }

  .number-counter {
    max-width: 240px;

    @include media($xs, max-width, 100%);

    &__button {
      height: 48px !important;
      min-width: unset !important;
      width: 48px;
      background-color: $dark_grey !important;
      border-radius: 0 !important;
      position: relative;

      &::before,
      &::after {
        content: "";
        display: block;
        position: absolute;
        top: calc(50% - 1px);
        left: calc(50% - 15px);
        width: 30px;
        height: 2px;
        background-color: $soft_white;
        opacity: 1 !important;
      }

      &::after {
        transform: rotate(90deg);
      }

      &.v-btn--disabled.v-btn--has-bg {
        border: solid 2px $light_blue;

        &::before,
        &::after {
          background-color: $light_blue;
        }
      }

      &.minus {
        &::after {
          display: none;
        }
      }
    }
  }
</style>
