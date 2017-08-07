<template>
  <div>
    <div class="list-group">
      <a class="btn btn-primary btn-sm" @click="showAdd()"><span><i class="fa fa-caret-right" v-if="!this.clicked"></i> <i class="fa fa-caret-down" v-else></i> {{ course }} - {{ task.title }} | {{ task.due_date }}</span></a>
      <div v-show="this.clicked">
        <div class="jumbotron">
          <form role="form" @submit.prevent="addSubTask()">
            <div class="row">
              <div class="col-xs-4">
                <date-picker input-class="form-control" :disabled="this.state.disabled" format="MMM dd yyyy" placeholder="Desire Due Date" v-model="due_date"></date-picker>
              </div>
              <div class="col-xs-7">
                <input class="form-control" v-model="subtask" placeholder="Brief Description About Subtask" required>
              </div>
              <div class="col-xs-1">
                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
              </div>
            </div>
          </form>
        </div>
        <a v-for="subtask in subtasks" class="list-group-item list-group-item-default">
          {{ subtask.task }} | {{ subtask.due_date }}
          <button id="deleteSubTask" class="btn btn-danger btn-sm" @click="deleteSubTask(subtask.id)">X</button>
        </a>
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
        due_date: '',
        isActive: false,
        subtask: '',
        subtasks: {},
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

      deleteSubTask(task_id) {
        axios.delete('/sub-task/' + task_id)
        .catch(err => {
          alert(err);
        });

        this.fetchSubTasks();
      },

      addSubTask() {
        axios.post('/sub-task', {
          'task_id': this.task.id,
          'task': this.subtask,
          'due_date': this.due_date
        });

        this.due_date = '';
        this.subtask = '';

        this.fetchSubTasks();
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
  .jumbotron {
    margin-top: 10px;
    margin-bottom: -1px;
    background-color: white;
  }
  #deleteSubTask, #editSubTask {
    /*display: flex;*/
    justify-content: flex-end;
  }
</style>
