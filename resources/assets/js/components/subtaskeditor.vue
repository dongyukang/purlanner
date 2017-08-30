<template>
  <div>
    <div class="container">
      <div class="jumbotron jumbotron-gradient">
        <form role="form" @submit.prevent="addSubTask()">
          <div class="row">
            <div class="col-xs-3">
              <select class="form-control" v-model="task_id">
                <option disabled selected> Select Your Task </option>
                <option v-for="task in tasks_data">
                  {{ task.title }}
                  by {{ task.due_date }}
                </option>
              </select>
            </div>
            <div class="col-xs-7">
              <input class="form-control" placeholder="What do you want to accomplish on this day?" v-model="subtask" required>
            </div>
            <div class="col-xs-2">
              <button type="submit" class="btn btn-danger">Save</button>
            </div>
          </div>
        </form>
      </div>

      <div>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <td style="text-align: center">Day</td>
              <td style="text-align: center">Todo</td>
              <td style="text-align: center">Due/Event</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="text-align: center"><h4> {{ day }} </h4></td>
              <td>
                <subtask-list :day="this.day" :month="this.month" :year="this.year"></subtask-list>
              </td>
              <td> 
                <task-list :day="this.day" :month="this.month" :year="this.year"></task-list>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
  import TaskList from './subtasks/TaskList.vue';
  import SubTaskList from './subtasks/SubTaskList.vue';

  export default {
    components: {
      'task-list': TaskList,
      'subtask-list': SubTaskList
    },

    props: ['day', 'month', 'year'],

    data() {
      return {
        task_id: '',
        task: '',
        tasks_data: [],
        subtask: ''
      }
    },

    methods: {
      addSubTask() {

      },

      fetchTasks() {
        axios.get('/tasksFromToday')
        .then(res => {
          var tasks = [];
          var today = new Date();

          tasks = res.data;

          var filtered = collect(tasks).filter((value, key) => {
            var date = new Date(value.due_date);
            date.setDate(date.getDate() + 1);

            var givenDate = new Date(this.year, this.month - 1, this.day);

            return date >= givenDate;
          });

          this.tasks_data = filtered.all();
        });
      }
    },

    mounted() {
      this.fetchTasks();
    }
  }
</script>

<style scoped>
    /*style="background-color: #EDEFF5;*/
  .jumbotron-gradient {
    background: rgba(147,206,222,1);
    background: -moz-linear-gradient(left, rgba(147,206,222,1) 0%, rgba(117,189,209,1) 41%, rgba(73,165,191,1) 100%);
    background: -webkit-gradient(left top, right top, color-stop(0%, rgba(147,206,222,1)), color-stop(41%, rgba(117,189,209,1)), color-stop(100%, rgba(73,165,191,1)));
    background: -webkit-linear-gradient(left, rgba(147,206,222,1) 0%, rgba(117,189,209,1) 41%, rgba(73,165,191,1) 100%);
    background: -o-linear-gradient(left, rgba(147,206,222,1) 0%, rgba(117,189,209,1) 41%, rgba(73,165,191,1) 100%);
    background: -ms-linear-gradient(left, rgba(147,206,222,1) 0%, rgba(117,189,209,1) 41%, rgba(73,165,191,1) 100%);
    background: linear-gradient(to right, rgba(147,206,222,1) 0%, rgba(117,189,209,1) 41%, rgba(73,165,191,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#93cede', endColorstr='#49a5bf', GradientType=1 );
  }
</style>
