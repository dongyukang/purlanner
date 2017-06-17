<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>{{ termname }}</h4>
      </div>

      <div class="panel-body" style="text-align: center;">
        <form method="post" @submit.prevent>
          <!-- class="selectpicker_subject show-tick" -->
          <select v-model="subject" data-live-search="true" @change="loadCourseNumbers()" title="Subject">
            <option v-for="subject in subjects_array" :value=subject>{{ subject }}</option>
          </select>

          <select v-model="number" data-live-search="true" @change="loadSections()" title="Course Number">
            <option v-for="course_number in course_numbers">{{ course_number.Number }} {{ course_number.Title }}</option>
          </select>

          <select v-model="section" title="Section">
          </select>

          <button type="submit" class="btn btn-primary">Add Course ( + )</button>
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
      section: '',
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

    loadSections() {
      this.section = undefined;
      if (this.number != undefined) {
        var title = ''
        var course = '';
        var courseInfo = this.number.split(" ");
        var courseNum = courseInfo[0];
        for (var i = 1; i < courseInfo.length; i++) {
          title += courseInfo[i] + ' ';
        }
        title = title.trim();
        courseNum = courseNum.trim();
        course = this.subject + ' ' + courseNum;

        axios.get('/api/getSections/' + course + '/' + title)
        .then(res => {
          this.sections = res.data;
        });

        console.log(this.sections);
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
