<template>
  <div>
    <div class="panel panel-default col-xs-3">
      <div class="panel-heading" style="text-align: center">
        <h4> Settings </h4>
      </div>
      <div class="panel-body">
        <div class="side-menu">
          <ul>
            <li>
              <a href="#"> Course Settings </a>
            </li>
            <li>
              <a href="#"> Personal Settings </a>
            </li>
            <li>
              <a href="#"> Security </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-xs-9">
      <setupcourses :subjects=this.subjects></setupcourses>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['subjects'],

    data() {
      return {
        course_settings: true,
        personal_settings: false,
        security: false
      }
    },

    methods: {
    }
  }
</script>

<style scoped>
</style>
