/**
 * Global default settings
 * Contents:
 *    - fields
 *    - ...
 */

 export const GlobalConstants = {
  fields: {
    textfield: { // + textarea
      rules: [],
      emptiness: [v => !!v || 'The field can\'t be empty']
    },
    email: {
      rules: [
        v => /.+@.+\..+/.test(v) || 'Not valid E-mail',
        v => !!v && v.length <= 254 || 'Too long E-mail'
      ],
      emptiness: [v => !!v || 'The field can\'t be empty']
    },
    number: {
      rules: [],
      emptiness: [v => !!v || 'The field can\'t be empty']
    },
    password: {
      rules: [
        v => !!v && v.length >= 8 || 'Password must be at least 8 characters long'
      ],
      emptiness: [v => !!v || 'The field can\'t be empty']
    }
  }
}
