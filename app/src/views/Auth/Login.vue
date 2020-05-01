<template>
  <v-form @submit.prevent="login()">
    <v-card class="elevation-12">
      <v-toolbar
          color="primary"
          dark
          flat>
        <v-toolbar-title>Login form</v-toolbar-title>
      </v-toolbar>
      <v-card-text>
        <v-text-field
            v-model="form.email"
            label="E-mail"
            :error-messages="showErrors('email')"
            class="purple-input"
            @keydown="delete serverMessages.email" />
        <v-text-field
            v-model="form.password"
            label="Password"
            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
            :type="showPassword ? 'text' : 'password'"
            class="purple-input"
            :error-messages="showErrors('password')"
            @click:append="showPassword = !showPassword"
            @keydown="delete serverMessages.password" />
      </v-card-text>
      <v-card-actions>
        <a
            href="javascript: void(0)"
            @click="$router.push('/auth/password-recovery')">
          Forgot my password
        </a>
        <v-spacer />
        <v-btn
            :loading="loading"
            type="submit"
            color="primary">
          Login
        </v-btn>
      </v-card-actions>
    </v-card>
    <base-material-snackbar
        color="danger"
        :value="invalidCredentials">
      Incorrect e-mail or password.
    </base-material-snackbar>
  </v-form>
</template>

<script>
  import authRepository from '@/repositories/AuthRepository'
  import validatorHelper from '@/utils/ValidatorHelper'
  import { required, email, minLength } from 'vuelidate/lib/validators'

  export default {
    data: () => ({
      form: {
        email: '',
        password: '',
      },
      showPassword: false,
      serverMessages: {},
      invalidCredentials: false,
      loading: false,
    }),

    validations() {
      return {
        form: {
          email: {
            required,
            email,
          },
          password: {
            required,
            minLength: minLength(8),
          },
        },
      }
    },

    methods: {
      login() {
        if (validatorHelper.isValid(this)) {
          this.loading = true
          authRepository.login(this.form)
            .then(() => {
              this.$store.dispatch('setToken', true)
              this.$router.push('/')
            })
            .catch(error => {
              this.serverMessages = error.serverMessages
              this.invalidCredentials = error.response.status === 401
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
