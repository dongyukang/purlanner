<template>
  <div>
    <div v-show="!clicked">
      <div class="col-xs-4" v-for="task in tasks">
        <div class="panel panel-default">
          <div class="panel-heading">
            <center> <h6>{{ task.title }}</h6> </center>
          </div>
          <div class="panel-body" style="text-align: center">
           <span class="label label-warning">DUE: {{ task.due_date }}</span>
           <span class="label label-success">{{ task.type }}</span>
           <span class="label label-danger">{{ task.course }}</span>
           <br><br>
           <a class="btn btn-primary btn-sm" @click="taskClicked(task.id)">SELECT</a>
          </div>
        </div>
      </div>
    </div>

    <div v-show="clicked">
      <date-selector :selectedTask="clickedTaskId"></date-selector>
      <center> <a class="btn btn-danger" @click="taskClicked()">Cancel</a> </center>
    </div>
  </div>
</template>

<script>
  import DateSelector from './DateSelector';

  export default {
    components: {
      'date-selector': DateSelector
    },

    data() {
      return {
        tasks: {},
        clicked: false,
        clickedTaskId: ''
      }
    },

    methods: {
      taskClicked(taskid = null) {
        this.clicked = !this.clicked;
        this.clickedTaskId = taskid;
      }
    },

    mounted() {
      axios.get('/tasksFromTodayWithCourseNumber')
      .then(res => {
        this.tasks = res.data;
      });
    }
  }
</script>

<style scoped>
</style>
