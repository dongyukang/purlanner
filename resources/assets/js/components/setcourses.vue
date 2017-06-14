<template>
  <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>{{ termname }}</h4>
      </div>

      <div class="panel-body" style="text-align: center;">
        <form method="post" @submit.prevent>
          <select class="selectpicker_subject" v-model="subject" data-live-search="true" @change="loadCourseNumbers()" title="Subject">
            <option v-for="subject in subjects_array" :value=subject>{{ subject }}</option>
          </select>

          <select class="selectpicker_number" v-model="number" data-live-search="true" @change="loadSections()" title="Course Number">
          </select>

          <select class="selectpicker_section" v-model="section" data-live-search="true" title="Section">
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
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>CS</td>
              <td>18000</td>
              <td>181</td>
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
      subjects_array: []
    }
  },

  methods: {
    loadCourseNumbers() {
      this.number = undefined;
      this.section = undefined;
    },

    loadSections() {
      this.section = undefined;
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
