<template>
  <base-list
      title="Subjects"
      entity="subject"
      url="/subjects"
      :headers="headers"
      :repository="subjectsRepository" />
</template>

<script>
  import subjectsRepository from '@/repositories/SubjectsRepository'

  export default {
    data: () => ({
      headers: [
        { text: 'ID', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'Actions', value: 'actions' },
      ],
      subjectsRepository,
    }),
  }
</script>
