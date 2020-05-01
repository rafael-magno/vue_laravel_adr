<template>
  <base-list
      title="Shifts"
      entity="shift"
      url="/shifts"
      :headers="headers"
      :repository="shiftsRepository" />
</template>

<script>
  import shiftsRepository from '@/repositories/ShiftsRepository'

  export default {
    data: () => ({
      headers: [
        { text: 'ID', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'Actions', value: 'actions' },
      ],
      shiftsRepository: shiftsRepository,
    }),
  }
</script>
