<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>{{ termname }}</h4>
      </div>

      <div class="panel-body" style="text-align: center;">
        <form method="post" @submit.prevent>
          <!-- class="selectpicker_subject show-tick" -->
          <select class="selectpicker_subject show-tick" v-model="subject" data-live-search="true" @change="loadCourseNumbers()" title="Subject">
            <option v-for="subject in subjects_array" :value=subject>{{ subject }}</option>
          </select>

          <select class="selectpicker_number show-tick col-xs-5" v-model="number" data-live-search="true" title="Course Number">
            <option v-for="course_number in course_numbers">{{ course_number.Number }} {{ course_number.Title }}</option>
          </select>

          <button type="submit" class="btn btn-primary">I Take This Course</button>
        </form>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <td>Subject</td>
              <td>Course Number</td>
              <td>Section Number</td>
              <td>Title</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>CS</td>
              <td>18000</td>
              <td>181</td>
              <td>Introduction to Programming</td>
              <td><a class="btn btn-danger">Delete</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['subjects'],

  data() {
    return {
      subject: '',
      number: '',
      termname: '',
      course_numbers: [],
      subjects_array: []
    }
  },

  watch: {
    subject() {
      $('.selectpicker_number').selectpicker('refresh');
    }
  },

  methods: {
    loadCourseNumbers() {
      this.number = undefined;
      this.section = undefined;
      axios.get('/api/getCourseNumbers/' + this.subject)
      .then(res => {
        this.course_numbers = res.data;
      });
    },
  },

  mounted() {
    this.subjects_array = JSON.parse(this.subjects);
    axios.get('/api/currentTermName')
    .then(res => {
      this.termname = res.data;
    });
  }
}
</script>

<style lang="css">
</style>
