<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>{{ termname }}</h4>
      </div>

      <div class="panel-body" style="text-align: center;">
        <form method="post" @submit.prevent>
          <!-- class="selectpicker_subject show-tick" -->
          <select v-model="subject" @change="loadCourseNumbers()" title="Subject">
            <option v-for="subject in subjects_array" :value=subject>{{ subject }}</option>
          </select>
           <!-- class="selectpicker_number show-tick col-xs-5" -->
          <select v-model="number" title="Course Number">
            <option v-for="course_number in course_numbers">{{ course_number.Number }} {{ course_number.Title }}</option>
          </select>

          <button type="submit" @click="registerCourse()">I Take This Course</button>
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
              <td>Title</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
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

  methods: {
    loadCourseNumbers() {
      this.number = undefined;
      axios.get('/api/getCourseNumbers/' + this.subject)
      .then(res => {
        this.course_numbers = res.data;
      });
    },

    registerCourse() {
      if (this.subject != undefined && this.number != undefined) {
        console.log(this.subject + ' ' + this.number);        
      }
    }
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
