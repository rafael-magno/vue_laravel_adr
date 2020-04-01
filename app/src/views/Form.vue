<script>
import validatorHelper from '../utils/validatorHelper'

export default {
  data: () => ({
    form: {},
    id: 0,
    serverValidationMessages: {}
  }),

  created () {
    this.id = this.$route.params.id
    if (this.id) {
      this.repository.getById(this.id)
        .then(response => this.form = response.data)
        .catch(() => this.$router.push(this.urlNotFound))
    }
  },

  methods: {
    save () {
      this.$v.$touch()
      if (!this.$v.$invalid && !Object.keys(this.serverValidationMessages).length) {
        this.repository.save(this.form, this.id)
          .then(() => this.$router.push(this.urlSuccess))
          .catch(error => this.serverValidationMessages = error.serverMessages)
      }
    },

    showErrors (field) {
      return validatorHelper.showErrors(this, field)
    }
  }
}
</script>
