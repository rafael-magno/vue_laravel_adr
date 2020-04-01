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
              <v-flex xs6>{{ title }}</v-flex>
              <v-flex
                xs6
                text-xs-right>
                <v-btn
                  class="my-0 mx-0 font-weight-light"
                  color="success"
                  @click="$router.push(url + '/new')">
                  New {{ entity }}
                </v-btn>
              </v-flex>
            </v-layout>
          </template>
          <v-data-table
            :headers="headers"
            :items="items.data"
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
              <td 
                v-for="header in headers"
                :key="header.value">
                {{ item[header.value] }}
              </td>
              <td>
                <i
                  aria-label="edit"
                  class="v-icon mdi mdi-pencil theme--light"
                  @click="$router.push(url + '/edit/' + item.id)" />
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
                v-if="items.total > perPageOptions[0]"
                v-model="perPage"
                :items="perPageOptions"
                label="Items per page" />
            </v-flex>
            <v-flex
              xs8 
              sd9>
              <v-pagination
                v-if="items.last_page > 1"
                v-model="page"
                :length="items.last_page" />
            </v-flex>
          </v-layout>
        </material-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    items: {},
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
      this.items = repository.getAll(this.page, this.perPage)
    }
  },

  methods: {
    confirmRemove (item, index) {
      this.$store.dispatch('openDialogConfirmation', {
        text: 'Do you really want to remove the ' + this.entity + ': ' + item.name + '?',
        callback: () => this.remove(item.id, index)
      })
    },

    remove (id, index) {
      repository.delete(id)
        .then(() => this.items.data.splice(index, 1))
    }
  }
}
</script>
