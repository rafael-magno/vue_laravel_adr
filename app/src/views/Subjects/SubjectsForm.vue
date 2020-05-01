<template>
  <base-form
      md="8"
      entity="subject"
      :repository="subjectsRepository"
      url-not-found="/subjects"
      url-success="/subjects"
      url-back="/subjects"
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
  import subjectsRepository from '@/repositories/SubjectsRepository'
  import { required } from 'vuelidate/lib/validators'

  export default {
    data: () => ({
      subjectsRepository,
      validations: {
        name: {
          required,
        },
      },
    }),
  }
</script>
