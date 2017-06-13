<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>{{ termname }}</h4>
      </div>

      <div class="panel-body">
        <select class="selectpicker_subjects" data-live-search="true">
          <option select="selected" value="default">Choose a subject</option>
          <option>{{ subjects }}</option>
        </select>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['termname', 'subjects'],

  data() {
    return {
    }
  }
}
</script>

<style lang="css">
</style>
