<template>
  <div>
    <div class="list-group">
      <a class="btn btn-primary btn-sm" @click="showAdd()"><span><i class="fa fa-caret-right" v-if="!this.clicked"></i> <i class="fa fa-caret-down" v-else></i> {{ course }} - {{ task.title }} | {{ task.due_date }}</span></a>
      <div v-show="this.clicked">
        <div class="jumbotron">
          <form role="form" @submit.prevent>
            <div class="row">
              <div class="col-xs-4">
                <div class="input-group date">
                  <input type="text" name="due_date" v-model="due_date" v-on:keyup="this.due_date = $event.due_date.value" class="form-control" placeholder="Desire due date" required><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div>
              </div>
              <div class="col-xs-7">
                <input class="form-control" v-model="subtask" placeholder="Brief description about subtask" required>
              </div>
              <div class="col-xs-1">
                <button @click="" class="btn btn-success"><i class="fa fa-plus"></i></button>
              </div>
            </div>
          </form>
        </div>
        <a class="list-group-item list-group-item-default" @click="">
          ddd
        </a>
        <a class="list-group-item list-group-item-default" @click="">
          ddd
        </a>
        <a class="list-group-item list-group-item-default" @click="">
          ddd
        </a>
      </div>
    </div>

  </div>
</template>

<script>
  export default {
    props: ['task_data', 'course'],

    data() {
      return {
        task: JSON.parse(this.task_data),
        clicked: false,
        due_date: '',
        subtask: ''
      }
    },

    methods: {
      showAdd() {
        this.clicked = !this.clicked;
      }
    },

    mounted() {
    }
  }
</script>

<style scoped>
  a {
    cursor: pointer;
  }
  span {
    font-size: 16px;
  }
  .jumbotron {
    margin-top: 10px;
    margin-bottom: -1px;
    background-color: white;
  }
</style>
