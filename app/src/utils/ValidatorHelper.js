class ValidatorHelper {
  constructor() {
    this.defaultMessages = {
      between: 'Must be between {min} and {max}.',
      email: 'Invalid e-mail.',
      ipAddress: 'Invalid IP.',
      macAddress: 'Invalid MAC.',
      required: 'This field is required.',
      requiredIf: 'This field is required.',
      requiredUnless: 'This field is required.',
      sameAs: 'Must be the same as {eq}.',
      url: 'Invalid URL.',
      minValue: 'Must be no less than {min}.',
      maxValue: 'Must be no more than {max}.',
      minLength: 'Must be no less than {min} characters.',
    }
  }

  showErrors(vue, field) {
    var messages = []
    if (!vue.$v.form[field].$dirty) {
      return messages
    }

    if (vue.serverMessages[field]) {
      return vue.serverMessages[field]
    }

    const rules = Object.values(vue.$v.form[field].$params)

    for (const rule of rules) {
      if (vue.$v.form[field][rule.type]) {
        continue
      }

      const message = this.getMessage(vue, field, rule)
      messages.push(message)
    }

    return messages
  }

  getMessage(vue, field, rule) {
    let message = this.defaultMessages[rule.type]

    if (
      vue.validationMessages &&
      vue.validationMessages[field] &&
      vue.validationMessages[field][rule.type]
    ) {
      message = vue.validationMessages[field][rule.type]
    }

    for (const param in rule) {
      const find = new RegExp(`{${param}}`, 'g')
      message = message.replace(find, rule[param])
    }

    return message
  }

  isValid(vue) {
    vue.$v.$touch()

    return !vue.$v.$invalid && !Object.keys(vue.serverMessages).length
  }
}

export default new ValidatorHelper()
