<template>
  <v-container
    fill-height
    fluid
    grid-list-xl>
    <v-layout
      justify-center
      wrap>
      <v-flex md12>
        <material-card color="green">
          <template v-slot:header>
            <v-layout wrap>
              <v-flex xs6>Shifts</v-flex>
              <v-flex
                xs6
                text-xs-right>
                <v-btn
                  class="my-0 mx-0 font-weight-light"
                  color="success"
                  @click="$router.push('/shifts/new')">
                  New shift
                </v-btn>
              </v-flex>
            </v-layout>
          </template>
          <v-data-table
            :headers="headers"
            :items="shifts.data"
            hide-actions>
            <template
              slot="headerCell"
              slot-scope="{ header }">
              <span
                class="subheading font-weight-light text-success text--darken-3"
                v-text="header.text" />
            </template>
            <template
              slot="items"
              slot-scope="{ item, index }">
              <td>{{ item.id }}</td>
              <td>{{ item.name }}</td>
              <td>
                <i
                  aria-label="edit"
                  class="v-icon mdi mdi-pencil theme--light"
                  @click="$router.push('/shifts/edit/' + item.id)" />
                <i
                  aria-hidden="remove"
                  class="v-icon mdi mdi-close-circle theme--light"
                  @click="confirmRemove(item, index)"/>
              </td>
            </template>
          </v-data-table>
          <v-layout 
            wrap>
            <v-flex
              xs4 
              sd3>
              <v-select
                v-if="shifts.total > perPageOptions[0]"
                v-model="perPage"
                :items="perPageOptions"
                label="Items per page" />
            </v-flex>
            <v-flex
              xs8 
              sd9>
              <v-pagination
                v-if="shifts.last_page > 1"
                v-model="page"
                :length="shifts.last_page" />
            </v-flex>
          </v-layout>
        </material-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import shiftsRepository from '@/repositories/ShiftsRepository'

export default {
  data: () => ({
    headers: [
      { text: 'ID', value: 'id' },
      { text: 'Name', value: 'name' },
      { text: 'Actions', value: 'actions' }
    ],
    shifts: {},
    page: 1,
    perPage: null,
    perPageOptions: []
  }),

  created () {
    this.perPage = process.env.VUE_APP_DEFAULT_PER_PAGE
    this.perPageOptions = process.env.VUE_APP_PER_PAGE_OPTIONS.split(',')
  },

  computed: {
    pagination() {
      return this.page + '|' + this.perPage
    }
  },

  watch: {
    pagination() {
      this.shifts = shiftsRepository.getAll(this.page, this.perPage)
    }
  },

  methods: {
    confirmRemove (item, index) {
      this.$store.dispatch('openDialogConfirmation', {
        text: 'Do you really want to remove the shift: ' + item.name + '?',
        callback: () => this.remove(item.id, index)
      })
    },

    remove (id, index) {
      shiftsRepository.delete(id)
        .then(() => this.shifts.data.splice(index, 1))
    }
  }
}
</script>
