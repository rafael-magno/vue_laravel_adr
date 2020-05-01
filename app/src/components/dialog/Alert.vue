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
            :color="dialog.color"
            text
            @click="dialog.callback(); hideDialog()">
          Ok
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

      show: {
        get() {
          return this.dialog.type === 'alert'
        },
        set(visible) {
          if (!visible) {
            this.hideDialog()
          }
        },
      },
    },

    methods: {
      ...mapActions(['hideDialog']),
    },
  }
</script>
