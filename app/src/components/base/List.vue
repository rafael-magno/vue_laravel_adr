<template>
  <v-container
      id="regular-tables"
      fluid
      tag="section">
    <base-material-card color="green">
      <template #heading>
        <v-row>
          <v-col cols="6">
            {{ title }}
          </v-col>
          <v-col
              cols="6"
              class="text-right">
            <v-btn
                class="my-0 mx-0 font-weight-light"
                color="success"
                @click="$router.push(url + '/new')">
              New {{ entity }}
            </v-btn>
          </v-col>
        </v-row>
      </template>
      <v-data-table
          :headers="headers"
          :items="items.data"
          hide-default-footer>
        <template #headerCell="{ header }">
          <span
              class="subheading font-weight-light text-success text--darken-3"
              v-text="header.text" />
        </template>
        <template #item.actions="{ item, index }">
          <td>
            <i
                aria-label="edit"
                class="v-icon mdi mdi-pencil theme--light"
                @click="$router.push(url + '/edit/' + item.id)" />
            <i
                aria-hidden="remove"
                class="v-icon mdi mdi-close-circle theme--light"
                @click="confirmRemove(item, index)" />
          </td>
        </template>
      </v-data-table>
      <v-row>
        <v-col
            class="sd"
            cols="4">
          <v-select
              v-if="items.total > perPageOptions[0]"
              v-model="perPage"
              :items="perPageOptions"
              label="Items per page" />
        </v-col>
        <v-col
            class="sd"
            cols="8">
          <v-pagination
              v-if="items.last_page > 1"
              v-model="page"
              :length="items.last_page" />
        </v-col>
      </v-row>
    </base-material-card>
  </v-container>
</template>

<script>
  export default {
    props: {
      title: {
        type: String,
        required: true,
      },
      entity: {
        type: String,
        required: true,
      },
      url: {
        type: String,
        required: true,
      },
      headers: {
        type: Array,
        required: true,
      },
      repository: {
        type: Object,
        required: true,
      },
    },

    data: () => ({
      items: {},
      page: 1,
      perPage: null,
      perPageOptions: [],
    }),

    computed: {
      pagination() {
        return this.page + '|' + this.perPage
      },
    },

    watch: {
      async pagination() {
        this.items = await this.repository.getAll(this.page, this.perPage)
      },
    },

    created() {
      this.perPage = process.env.VUE_APP_DEFAULT_PER_PAGE
      this.perPageOptions = process.env.VUE_APP_PER_PAGE_OPTIONS.split(',')
    },

    methods: {
      confirmRemove(item, index) {
        this.$store.dispatch('openDialogConfirmation', {
          text: 'Do you really want to remove the ' + this.entity + ': ' + item.name + '?',
          callback: () => this.remove(item.id, index),
        })
      },

      remove(id, index) {
        this.repository.delete(id)
          .then(() => this.items.data.splice(index, 1))
      },
    },
  }
</script>
