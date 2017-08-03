<template>
  <div>
    <div class="list-group">
      <a class="list-group-item">
        
      </a>
    </div>
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
