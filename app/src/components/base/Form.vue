<template>
  <v-container
      id="user-profile"
      fluid
      tag="section">
    <v-row justify="center">
      <v-col v-bind="$attrs">
        <base-material-card
            :title="(id ? 'Edit ' : 'New ') + entity"
            color="green">
          <v-form @submit.prevent="save()">
            <v-container class="py-0">
              <slot
                  :form="form"
                  :serverMessages="serverMessages"
                  :showErrors="showErrors" />
              <v-row>
                <v-col
                    cols="6"
                    class="text-left">
                  <v-btn
                      v-if="urlBack"
                      class="mx-0"
                      color="grey"
                      @click="$router.push(urlBack)">
                    Back
                  </v-btn>
                </v-col>
                <v-col
                    cols="6"
                    class="text-right">
                  <v-btn
                      :loading="loading"
                      type="submit"
                      class="mx-0"
                      color="success">
                    Save
                  </v-btn>
                </v-col>
              </v-row>
            </v-container>
          </v-form>
        </base-material-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
  import validatorHelper from '@/utils/ValidatorHelper'

  export default {
    props: {
      entity: {
        type: String,
        required: true,
      },
      repository: {
        type: Object,
        required: true,
      },
      urlNotFound: {
        type: String,
        required: true,
      },
      urlSuccess: {
        type: String,
        required: true,
      },
      urlBack: {
        type: String,
        default: '',
      },
      validations: {
        type: Object,
        default: () => {},
      },
      validationMessages: {
        type: Object,
        default: () => {},
      },
    },

    data: () => ({
      form: {},
      id: 0,
      serverMessages: {},
      loading: false,
    }),

    async created() {
      this.id = this.$route.params.id
      if (this.id) {
        try {
          this.form = await this.repository.getById(this.id)
        } catch (error) {
          this.$router.push(this.urlNotFound)
        }
      }
    },

    methods: {
      save() {
        if (validatorHelper.isValid(this)) {
          this.loading = true
          this.repository.save(this.form, this.id)
            .then(() => this.$router.push(this.urlSuccess))
            .catch(error => this.serverMessages = error.serverMessages)
            .finally(() => {
              this.loading = false
            })
        }
      },

      showErrors(field) {
        return validatorHelper.showErrors(this, field)
      },
    },

    validations() {
      return {
        form: this.validations,
      }
    },
  }
</script>
