<template>
  <v-dialog
    v-model="show"
    max-width="290"
  >
    <v-card>
      <v-card-title
        v-if="title"
        class="headline"
        v-html="title" />
      <v-card-text
        v-if="text"
        v-html="text" />
      <v-card-actions>
        <v-spacer/>
        <v-btn
          :color="color"
          text
          @click="$emit('ok'); $store.dispatch('hideDialog')"
        >
          Ok
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: ''
    },
    text: {
      type: String,
      default: ''
    },
    color: {
      type: String,
      default: ''
    },
    show: {
      type: Boolean,
      default: false
    }
  },

  methods: {
    hide () {}
  }
}
</script>
