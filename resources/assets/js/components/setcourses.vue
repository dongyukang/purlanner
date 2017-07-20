<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>{{ termname }}</h4>
      </div>

      <div class="panel-body" style="text-align: center;">
        <form method="post" @submit.prevent>

          <select v-model="subject" @change="loadCourseNumbers()" title="Subject">
            <option v-for="subject in subjects_array" :value=subject>{{ subject }}</option>
          </select>

          <select v-model="number" title="Course Number">
            <option v-for="course_number in course_numbers">{{ course_number.Number }} {{ course_number.Title }}</option>
          </select>

          <button class="btn btn-success" type="submit" @click="saveCourse()">Add To My Course List (+)</button>

        </form>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>My Course List</h4>
      </div>
      <div class="panel-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <td>Subject</td>
              <td>Number</td>
              <td>Title</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="course in this.table_array">
              <td>{{ course.Subject }}</td>
              <td>{{ course.Number }}</td>
              <td>{{ course.Title }}</td>
              <td><button @click="removeCourse(course.Id)" class="btn btn-danger">Remove Course (-)</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['subjects', 'courses'],

  data() {
    return {
      subject: '',
      number: '',
      termname: '',
      course_numbers: [],
      subjects_array: [],
      courses_array:  [],
      table_array:    []
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

    saveCourse() {
      if ((this.subject != '' && this.subject != undefined) && (this.number != '' && this.number != undefined)) {
        var number = '';
        var title = '';

        number = this.number.split(' ');
        for (var i = 1; i < number.length; i++) {
          title += number[i] + ' ';
        }

        title = title.trim();

        axios.post('/api/saveCourse', {
          subject: this.subject,
          course_number: this.number.split(" ")[0],
          course_title: title
        });

        alert(this.subject + " " + this.number.split(" ")[0] + " is added to your course list.");
      }
    },

    removeCourse(course_id) {
      axios.post('/api/removeCourse', {
        course_id: course_id
      });
    },

    fetch() {
      this.table_array = this.courses_array;
    }
  },

  mounted() {
    this.subjects_array = JSON.parse(this.subjects);
    this.courses_array = JSON.parse(this.courses);
    this.fetch();

    axios.get('/api/currentTermName')
    .then(res => {
      this.termname = res.data;
    });
  }
}
</script>

<style lang="css">
</style>
