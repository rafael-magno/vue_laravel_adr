<template>
  <v-form @submit.prevent="sendRecoverLink()">
    <v-card class="elevation-12">
      <v-toolbar
          color="primary"
          dark
          flat>
        <v-toolbar-title>Change password form</v-toolbar-title>
      </v-toolbar>
      <v-card-text>
        <v-text-field
            v-model="form.password"
            label="New password"
            :append-icon="showPassword1 ? 'mdi-eye' : 'mdi-eye-off'"
            :type="showPassword1 ? 'text' : 'password'"
            class="purple-input"
            :error-messages="showErrors('password')"
            @click:append="showPassword1 = !showPassword1"
            @keydown="delete serverMessages.password" />
        <v-text-field
            v-model="form.confirm_password"
            label="Repeat password"
            :append-icon="showPassword2 ? 'mdi-eye' : 'mdi-eye-off'"
            :type="showPassword2 ? 'text' : 'password'"
            class="purple-input"
            :error-messages="showErrors('confirm_password')"
            @click:append="showPassword2 = !showPassword2"
            @keydown="delete serverMessages.confirm_password" />
      </v-card-text>
      <v-card-actions>
        <v-spacer />
        <v-btn
            :loading="loading"
            type="submit"
            color="primary">
          Change password
        </v-btn>
      </v-card-actions>
    </v-card>
    <input
        v-model="form.hash"
        type="hidden">
  </v-form>
</template>

<script>
  import authRepository from '@/repositories/AuthRepository'
  import validatorHelper from '@/utils/ValidatorHelper'
  import { required, minLength, sameAs } from 'vuelidate/lib/validators'

  export default {
    data: () => ({
      form: {
        password: '',
        confirm_password: '',
        hash: '',
      },
      showPassword1: false,
      showPassword2: false,
      serverMessages: {},
      loading: false,
    }),

    validations() {
      return {
        form: {
          password: {
            required,
            minLength: minLength(8),
          },
          confirm_password: {
            required,
            sameAs: sameAs('password'),
          },
        },
      }
    },

    created() {
      this.form.hash = this.$route.params.hash
    },

    methods: {
      sendRecoverLink() {
        if (validatorHelper.isValid(this)) {
          this.loading = true
          authRepository.resetPassword(this.form)
            .then(response => {
              this.$router.push('/auth/login')
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
