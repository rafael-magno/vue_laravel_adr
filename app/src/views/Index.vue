<template>
  <v-app>
    <core-app-bar />
    <core-drawer />
    <core-view />
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
