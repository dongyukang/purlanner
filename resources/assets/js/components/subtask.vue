<template>
  <div>
    <div class="list-group">
      <a class="btn btn-primary btn-sm" @click="showAdd()"><span><i class="fa fa-caret-right" v-if="!this.clicked"></i> <i class="fa fa-caret-down" v-else></i> {{ course }} - {{ task.title }} | {{ task.due_date }}</span></a>
      <div v-show="this.clicked">
        <div class="jumbotron jumbotron-white">
          <p style="color: red; font-size: 15px;">
            *Click on the day that you want to add your subtasks.
          </p>
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <td style="text-align: center">Day</td>
                <td style="text-align: center">Due/Event Date</td>
                <td style="text-align: center">Todo</td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="date in this.dates">
                <td style="text-align: center">
                  <a style="cursor: pointer; text-decoration: none;" @click="addTodo(date)"><h4> {{ date.getDate() }} </h4></a>
                </td>
                <td>
                  <task-list :month="date.getMonth() + 1" :day="date.getDate()" :year="date.getFullYear()"></task-list>
                </td>
                <td>
                </td>
              </tr>
            </tbody>
          </table>
          <div>
            <form role="form" v-show="this.desire_date != ''" @submit.prevent>
              <div class="jumbotron" style="background-color: #97cd76;">
                <div class="row">
                  <div class="col-xs-3">
                    <input class="form-control" disabled v-model="desire_date">
                  </div>
                  <div class="col-xs-7">
                    <input class="form-control" v-model="todo" placeholder="Write Brief Description Of What You Want To Finish This Day.">
                  </div>
                  <div class="col-xs-1">
                    <button class="btn btn-info" @click="">Save</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div style="text-align:center;" v-if="this.isPaginatable">
          <ul class="pager">
           <li><a href="#"><i class="fa fa-arrow-left"></i> Previous 7 Days</a></li>
           <li><a href="#">Next 7 Days <i class="fa fa-arrow-right"></i></a></li>
         </ul>
       </div>
      </div>
    </div>
  </div>
</template>

<script>
  import TaskList from './subtasks/TaskList.vue';

  export default {
    components: {
      'task-list': TaskList
    },

    props: ['task_data', 'course', 'active_id', 'today'],

    data() {
      return {
        task: JSON.parse(this.task_data),
        currentDate: new Date(this.today),
        dateRange: [],
        desire_date: '',
        todo: '',
        clicked: false
      }
    },

    computed: {
      isPaginatable() {
        return (this.dateRange.length - 1) > 7;
      },

      dates() {
        /*
        ------------------------
        Setting Up Date Ranges
        ------------------------
         */
        // somehow, this.task.due_date is off by 1 day in Vue.
        var due_date = new Date(this.task.due_date);
        // therefore, add 1 day to get rid of date offset.
        due_date.setDate(due_date.getDate() + 1);

        for (var date = this.currentDate; date < due_date; date.setDate(date.getDate() + 1)) {
          this.dateRange.push(new Date(date));
        }

        // set to initial
        this.currentDate = new Date(this.today);

        /*
        ------------------------
        Divide By Seven Days
        ------------------------
         */
        if (this.isPaginatable) {
          var dates = [];

          for (var i = 0; i < 8; i++) {
            dates.push(this.dateRange[i]);
          }

          return dates;
        } else {
          return this.dateRange;
        }
      }
    },

    methods: {
      showAdd() {
        this.clicked = !this.clicked;
      },

      addTodo(date) {
        this.desire_date = date.getMonth() + 1 + '/' + date.getDate() + '/' + date.getFullYear();
      }
    },

    mounted() {
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
