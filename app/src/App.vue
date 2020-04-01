<template>
  <v-app>
    <core-drawer />
    <core-view />
    <dialog-confirmation
      :title="$store.getters.dialog.title"
      :text="$store.getters.dialog.text"
      :show="$store.getters.dialog.type == 'confirmation'"
      @yes="$store.getters.dialog.callback()" />
    <dialog-alert
      :title="$store.getters.dialog.title"
      :text="$store.getters.dialog.text"
      :show="$store.getters.dialog.type == 'alert'"
      :color="$store.getters.dialog.color"
      @ok="$store.getters.dialog.callback()" />
  </v-app>
</template>

<style lang="scss">
@import '@/styles/index.scss';

/* Remove in 1.2 */
.v-datatable thead th.column.sortable i {
  vertical-align: unset;
}
</style>
