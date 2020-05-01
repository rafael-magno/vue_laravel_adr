<template>
  <base-list
      title="Students"
      entity="student"
      url="/students"
      :headers="headers"
      :repository="studentsRepository" />
</template>

<script>
  import studentsRepository from '@/repositories/StudentsRepository'

  export default {
    data: () => ({
      headers: [
        { text: 'ID', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'Shift', value: 'shift_name' },
        { text: 'Actions', value: 'actions' },
      ],
      studentsRepository,
    }),
  }
</script>
