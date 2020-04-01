class ValidatorHelper {
  constructor () {
    this.defaultMessages = {
      between: 'Must be between {min} and {max}.',
      email: 'Invalid e-mail.',
      ipAddress: 'Invalid IP.',
      macAddress: 'Invalid MAC.',
      required: 'This field is required.',
      requiredIf: 'This field is required.',
      requiredUnless: 'This field is required.',
      sameAs: 'Must be the same as {field}.',
      url: 'Invalid URL.',
      minValue: 'Must be no less than {min}.',
      maxValue: 'Must be no more than {max}.'
    }
  }

  showErrors (vue, field) {
    var messages = []
    if (vue.$v.form[field].$dirty) {
      if (vue.serverValidationMessages[field]) {
        messages = vue.serverValidationMessages[field]
      } else {
        for (let param in vue.$v.form[field].$params) {
          if (!vue.$v.form[field][param]) {
            let message = this.defaultMessages[param]
            if (
              vue.validationMessages &&
              vue.validationMessages[field] &&
              vue.validationMessages[field][param]
            ) {
              message = vue.validationMessages[field][param]
            }
            messages.push(message)
          }
        }
      }
    }

    return messages
  }
}

export default new ValidatorHelper()
