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
              <v-flex xs6>Subjects</v-flex>
              <v-flex
                xs6
                text-xs-right>
                <v-btn
                  class="my-0 mx-0 font-weight-light"
                  color="success"
                  @click="$router.push('/subjects/new')">
                  New subject
                </v-btn>
              </v-flex>
            </v-layout>
          </template>
          <v-data-table
            :headers="headers"
            :items="items"
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
                  @click="$router.push('/subjects/edit/' + item.id)" />
                <i
                  aria-hidden="remove"
                  class="v-icon mdi mdi-close-circle theme--light"
                  @click="confirmRemove(item, index)"/>
              </td>
            </template>
          </v-data-table>
        </material-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import subjectsRepository from '@/repositories/SubjectsRepository'

export default {
  data: () => ({
    headers: [
      { text: 'ID', value: 'id' },
      { text: 'Name', value: 'name' },
      { text: 'Actions', value: 'actions' }
    ],
    items: []
  }),

  created () {
    subjectsRepository.getAll()
      .then(response => this.items = response.data.data)
  },

  methods: {
    confirmRemove (item, index) {
      this.$store.dispatch('openDialogConfirmation', {
        text: 'Do you really want to remove the subject: ' + item.name + '?',
        callback: () => this.remove(item.id, index)
      })
    },

    remove (id, index) {
      subjectsRepository.delete(id)
        .then(() => this.items.splice(index, 1))
    }
  }
}
</script>
