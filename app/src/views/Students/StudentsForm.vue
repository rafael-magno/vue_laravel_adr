<template>
  <v-container
    fill-height
    fluid
    grid-list-xl>
    <v-layout
      justify-center
      wrap>
      <v-flex
        xs12
        md8>
        <material-card
          :title="id ? 'Edit student' : 'New student'"
          color="green">
          <v-form @submit.prevent="save()">
            <v-container py-0>
              <v-layout wrap>
                <v-flex
                  xs12
                  md4>
                  <v-text-field
                    v-model="form.name"
                    :error-messages="showErrors('name')"
                    class="purple-input"
                    label="Name"
                    @keydown="delete serverValidationMessages.name" />
                </v-flex>
                <v-flex
                  xs12
                  md4>
                  <v-select
                    v-model="form.shifts_id"
                    :error-messages="showErrors('shifts_id')"
                    :itens="shifts"
                    class="purple-input"
                    label="Shift"
                    @change="delete serverValidationMessages.shifts_id" />
                </v-flex>
              </v-layout>
              <v-layout wrap>
                <v-flex
                  xs6
                  text-xs-left>
                  <v-btn
                    class="mx-0"
                    color="grey"
                    @click="$router.push('/students')">
                    Back
                  </v-btn>
                </v-flex>
                <v-flex
                  xs6
                  text-xs-right>
                  <v-btn
                    type="submit"
                    class="mx-0 font-weight-light"
                    color="success">
                    Save
                  </v-btn>
                </v-flex>
              </v-layout>
            </v-container>
          </v-form>
        </material-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import studentsRepository from '@/repositories/StudentsRepository'
import shiftsRepository from '@/repositories/ShiftsRepository'
import { required } from 'vuelidate/lib/validators'
import Form from '../Form'

export default {
  extends: Form,
  data: () => ({
    urlNotFound: '/students',
    urlSuccess: '/students/new',
    repository: studentsRepository,
    shifts: []
  }),

  created() {
    shiftsRepository.getAll()
      .then(respose => this.shifts = respose.data.data)
  },

  validations () {
    return {
      form: {
        name: {
          required
        },
        shifts_id: {
          required
        }
      }
    }
  }
}
</script>
