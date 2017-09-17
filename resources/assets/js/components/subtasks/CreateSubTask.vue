<template>
  <div>
    <div class="container">
      <div class="panel panel-default">
        <div class="panel-heading">
          <center>
            <h4>
              Manage Sub-Tasks
            </h4>
          </center>
        </div>
        <div class="panel-body">
          <task-selector></task-selector>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import TaskSelector from '../TaskSelector.vue';

  export default {
    components: {
      'task-selector': TaskSelector
    }
  }
</script>

<style scoped>
</style>
