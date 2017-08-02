<template>
  <div>
    <a style="cursor: pointer; color: white;" data-toggle="modal" data-target="#notifications"><i class="fa fa-bell fa-2x"></i> <span v-show="newExists" class="label label-danger" style="margin-bottom: 15px;">New</span></a>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        newExists: false
      }
    }
  }
</script>

<style scoped>
</style>
