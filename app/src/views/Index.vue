<template>
  <v-app>
    <core-app-bar />
    <core-drawer />
    <core-view />
    <dialog-confirmation />
    <dialog-alert />
  </v-app>
</template>

<script>
  export default {
    name: 'Index',

    data: () => ({
      expandOnHover: false,
    }),
  }
</script>
