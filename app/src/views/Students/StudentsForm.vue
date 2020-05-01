<template>
  <base-form
      entity="student"
      :repository="studentsRepository"
      url-not-found="/students"
      url-success="/students/new"
      url-back="/students"
      :validations="validations"
      :validation-messages="validationMessages">
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
        <v-col md="4">
          <v-select
              v-model="form.shift_id"
              :error-messages="showErrors('shift_id')"
              :items="shifts.data"
              item-text="name"
              item-value="id"
              class="purple-input"
              label="Shift"
              @change="delete serverMessages.shift_id" />
        </v-col>
        <v-col>
          <p class="mb-0">
            Subjects
          </p>
          <v-checkbox
              v-for="subject in subjects.data"
              :key="subject.id"
              v-model="form.subjects_id"
              class="mt-0"
              :label="subject.name"
              :value="subject.id"
              hide-details
              @click="delete serverMessages.subjects_id" />
          <p
              class="caption mt-1 mb-0"
              v-text="showErrors('subjects_id')" />
        </v-col>
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
  import studentsRepository from '@/repositories/StudentsRepository'
  import shiftsRepository from '@/repositories/ShiftsRepository'
  import subjectsRepository from '@/repositories/SubjectsRepository'
  import { required } from 'vuelidate/lib/validators'

  export default {
    data: () => ({
      studentsRepository,
      shifts: [],
      subjects: [],
      validations: {
        name: {
          required,
        },
        shift_id: {
          required,
        },
        subjects_id: {
          required,
        },
      },
      validationMessages: {
        subjects_id: {
          required: 'Select at least one.',
        },
      },
    }),

    async created() {
      this.shifts = await shiftsRepository.getAll()
      this.subjects = await subjectsRepository.getAll()
    },
  }
</script>
