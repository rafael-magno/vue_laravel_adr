<template>
  <v-form @submit.prevent="sendRecoverLink()">
    <v-card class="elevation-12">
      <v-toolbar
          color="primary"
          dark
          flat>
        <v-toolbar-title>Enter your registered email</v-toolbar-title>
      </v-toolbar>
      <v-card-text>
        <v-text-field
            v-model="form.email"
            label="E-mail"
            :error-messages="showErrors('email')"
            class="purple-input"
            @keydown="delete serverMessages.email" />
      </v-card-text>
      <v-card-actions>
        <v-spacer />
        <v-btn
            :loading="loading"
            type="submit"
            color="primary">
          Continue
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-form>
</template>

<script>
  import authRepository from '@/repositories/AuthRepository'
  import validatorHelper from '@/utils/ValidatorHelper'
  import { required, email } from 'vuelidate/lib/validators'

  export default {
    data: () => ({
      form: {
        email: '',
      },
      serverMessages: {},
      loading: false,
    }),

    validations() {
      return {
        form: {
          email: {
            required,
            email,
          },
        },
      }
    },

    methods: {
      sendRecoverLink() {
        if (validatorHelper.isValid(this)) {
          this.loading = true
          authRepository.passwordRecovery(this.form)
            .then(response => {
              this.$router.push('/auth/password-recovery-confirmation/' + this.form.email)
            })
            .catch(error => {
              this.serverMessages = error.serverMessages
            })
            .finally(() => {
              this.loading = false
            })
        }
      },

      showErrors(field) {
        return validatorHelper.showErrors(this, field)
      },
    },
  }
</script>
