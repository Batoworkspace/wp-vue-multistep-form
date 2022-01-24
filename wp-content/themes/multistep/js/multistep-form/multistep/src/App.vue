<template>
  <v-app>
    <v-main>
      <v-container tag="section">
        <v-row>
          <v-col>
            <multistep-form :settings="settings" />
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import MultistepForm from './components/MultistepForm'
const themeString = document.querySelector('#theme-name')
const themeName = themeString ? themeString.textContent : 'multistep'

export default {
  name: "Multistep Form App",

  components: {
    MultistepForm
  },

  data () {
    return {
      settings: null
    }
  },

  created () {
    this.getSettings()
  },

  methods: {
    // Get Form settings via browser

    async getSettings () {
      let response = await fetch(`/wp-content/themes/${themeName}/js/multistep-form/multistep/multistep-settings.json`)
      let data = await response.json()

      this.settings = data
    }
  }
}
</script>
