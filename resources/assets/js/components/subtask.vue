<template>
  <div>
  </div>
</template>

<script>
  export default {
    props: ['task_data', 'course'],

    data() {
      return {
        task: JSON.parse(this.task_data)
      }
    },

    mounted() {
    }
  }
</script>

<style scoped>
</style>
