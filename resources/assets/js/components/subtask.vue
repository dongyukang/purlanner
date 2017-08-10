<template>
  <div>
    <div class="list-group">
      <a class="btn btn-primary btn-sm" @click="showAdd()"><span><i class="fa fa-caret-right" v-if="!this.clicked"></i> <i class="fa fa-caret-down" v-else></i> {{ course }} - {{ task.title }} | {{ task.due_date }}</span></a>
      <div v-show="this.clicked">
        <div class="jumbotron jumbotron-white">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <td>Day</td>
                <td>Due/Event Date</td>
                <td>Todo List</td>
              </tr>
            </thead>
            <tbody>
              <tr>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="jumbotron jumbotron-white">
          <form role="form" @submit.prevent="addSubTask()">
            <div class="row">
              <div class="col-xs-7">
                <input class="form-control" v-model="subtask" placeholder="Brief Description About Subtask EX) Finish introduction..." required>
              </div>
              <div class="col-xs-4">
                <date-picker input-class="form-control" :disabled="this.state.disabled" placeholder="Desire Due Date" v-model="desire_date"></date-picker>
              </div>
              <div class="col-xs-1">
                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
              </div>
            </div>
          </form>
        </div>
        <div v-for="subtask in subtasks">
          <a class="list-group-item list-group-item-default" @click="changeToEditable()">
            <strong style="color: red">{{ subtask.task }}</strong> by <strong>{{ subtask.due_date }}</strong>
            <button id="deleteSubTask" class="btn btn-danger btn-sm" @click="deleteSubTask(subtask.id)">X</button>
            <subtask-editor v-show="editable"></subtask-editor>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  var now = new Date();
  now.setDate(now.getDate() - 1);

  export default {
    props: ['task_data', 'course', 'active_id'],

    data() {
      return {
        task: JSON.parse(this.task_data),
        clicked: false,
        isActive: false,
        desire_date: '',
        subtask: '',
        subtasks: {},
        editable: false,
        state: {
          disabled: {
            to: now
          }
        }
      }
    },

    methods: {
      showAdd() {
        this.clicked = !this.clicked;
      },

      fetchSubTasks() {
        axios.get('/subtasksByTask/' + this.task.id)
        .then(res => {
          this.subtasks = res.data;
        });
      },

      changeToEditable(task, due_date) {
        this.editable = !this.editable;
      },

      deleteSubTask(task_id) {
        axios.delete('/sub-task/' + task_id)
        .catch(err => {
          alert(err);
        }).then(res => {
          this.fetchSubTasks();
        });
      },

      addSubTask() {
        axios.post('/sub-task', {
          'task_id': this.task.id,
          'task': this.subtask,
          'due_date': this.desire_date
        }).then(res => {
          this.fetchSubTasks();
        });

        this.due_date = '';
        this.subtask = '';
      }
    },

    mounted() {
      this.fetchSubTasks();

      if (this.active_id == this.task.id) {
        this.clicked = true;
      }
    }
  }
</script>

<style scoped>
  a {
    cursor: pointer;
  }
  a:hover.list-group-item {
    background-color: white;
  }
  span {
    font-size: 16px;
  }
  .jumbotron-white {
    margin-top: 10px;
    margin-bottom: -1px;
    background-color: white;
  }
  #deleteSubTask, #editSubTask {
    /*display: flex;*/
    justify-content: flex-end;
  }
</style>
