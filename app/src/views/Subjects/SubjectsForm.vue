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
          :title="id ? 'Edit subject' : 'New subject'"
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
              </v-layout>
              <v-layout wrap>
                <v-flex
                  xs6
                  text-xs-left>
                  <v-btn
                    class="mx-0"
                    color="grey"
                    @click="$router.push('/subjects')">
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
import subjectsRepository from '@/repositories/SubjectsRepository'
import { required } from 'vuelidate/lib/validators'
import Form from '../Form'

export default {
  extends: Form,
  data: () => ({
    urlNotFound: '/subjects',
    urlSuccess: '/subjects/new',
    repository: subjectsRepository
  }),

  validations () {
    return {
      form: {
        name: {
          required
        }
      }
    }
  }
}
</script>
