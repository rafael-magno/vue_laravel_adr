<template>
  <v-card class="elevation-12">
    <v-toolbar
        color="primary"
        dark
        flat>
      <v-toolbar-title>Password recovery confirmation</v-toolbar-title>
    </v-toolbar>
    <v-card-text>
      <p>
        An email with a password recovery link was sent to
        <strong>{{ $route.params.email }}</strong>
      </p>
    </v-card-text>
  </v-card>
</template>
