<template>
  <v-dialog
      v-model="show"
      max-width="290">
    <v-card>
      <v-card-title
          v-if="dialog.title"
          class="headline"
          v-html="dialog.title" />
      <v-card-text
          v-if="dialog.text"
          v-html="dialog.text" />
      <v-card-actions>
        <v-spacer />
        <v-btn
            color="green darken-1"
            text
            @click="dialog.callback(); hideDialog()">
          Yes
        </v-btn>
        <v-btn
            color="red darken-1"
            text
            @click="hideDialog()">
          No
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
  import { mapState, mapActions } from 'vuex'

  export default {
    computed: {
      ...mapState(['dialog']),

      show() {
        return this.dialog.type === 'confirmation'
      },
    },

    methods: {
      ...mapActions(['hideDialog']),
    },
  }
</script>
