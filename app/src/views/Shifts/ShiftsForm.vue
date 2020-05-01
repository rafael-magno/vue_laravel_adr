<template>
  <base-form
      md="8"
      entity="shift"
      :repository="shiftsRepository"
      url-not-found="/shifts"
      url-success="/shifts/new"
      url-back="/shifts"
      :validations="validations">
    <template #default="{ form, serverMessages, showErrors }">
      <v-row>
        <v-col md="4">
          <v-text-field
              v-model="form.name"
              :error-messages="showErrors('name')"
              class="purple-input"
              label="Name"
              @keydown="delete serverMessages.name" />
        </v-col>
      </v-row>
    </template>
  </base-form>
</template>

<script>
  import shiftsRepository from '@/repositories/ShiftsRepository'
  import { required } from 'vuelidate/lib/validators'

  export default {
    data: () => ({
      shiftsRepository,
      validations: {
        name: {
          required,
        },
      },
    }),
  }
</script>
