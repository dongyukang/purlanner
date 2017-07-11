<template>
  <div>
    <div class="panel panel-default col-xs-3">
      <div class="panel-heading">
        <h4> Settings </h4>
      </div>
      <div class="panel-body">
        <div class="side-menu">
          <ul>
            <li>
              <a @click="activateCourseSettings()" href="#"> Course Settings </a>
            </li>
            <li>
              <a @click="activatePersonalSettings()" href="#"> Personal Settings </a>
            </li>
            <li>
              <a @click="activateSecuritySettings()" href="#"> Security Settings </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-xs-9">
      <setupcourses v-if="course_settings" :subjects=this.subjects :courses=this.courses></setupcourses>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['subjects', 'courses'],

    data() {
      return {
        course_settings: true,
        personal_settings: false,
        security_settings: false
      }
    },

    methods: {
      activateCourseSettings() {
        this.course_settings = true;
        this.personal_settings = false;
        this.security_settings = false;
      },

      activatePersonalSettings() {
        this.course_settings = false;
        this.personal_settings = true;
        this.security_settings = false;
      },

      activateSecuritySettings() {
        this.course_settings = false;
        this.personal_settings = false;
        this.security_settings = true;
      }
    }
  }
</script>

<style scoped>
</style>
