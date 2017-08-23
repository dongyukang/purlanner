<template>
  <div>
    <div class="container">
      <div v-if="!dayClicked">
        <p>
          <div class="jumbotron jumbotron-gradient" style="background-color: #e4e9f2;">
            <center><h2 style="color: white">{{ months[currentDate.month - 1] }}, {{ currentDate.year }}</h2></center>

            <div style="margin-top: 40px;">
              <ul class="pager">
                <li><a style="margin-right: 35px; cursor: pointer;" @click="prevMonth()" v-show="canPrev"><i class="fa fa-arrow-left"></i> Prev Month</a></li>
                <li><a style="cursor: pointer;" @click="nextMonth()" v-show="canNext">Next Month <i class="fa fa-arrow-right"></i></a></li>
              </ul>
            </div>
          </div>
        </p>
        <p style="color: red;">
          * Click on the day that you wish to write your subtasks.
        </p>
        <div class="panel panel-default">
          <div class="panel-heading" style="text-align: center">
            <i class="fa fa-calendar fa-4x"></i>
          </div>
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <td>Day</td>
                  <td>Todo</td>
                  <td>Due/Event</td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="date in dates">
                  <td style="text-align: center"><a style="cursor: pointer; text-decoration: none;" @click="changeDayClickStatus(date)">
                    <button class="btn btn-default btn-sm"><h4>{{ date.getDate() }}</h4> {{ days[date.getDay()] }}</button>
                  </a></td>
                   <!-- @task-clicked="changeDayClickStatus()" -->
                  <td><subtask-list :month="date.getMonth() + 1" :day="date.getDate()" :year="date.getFullYear()"></subtask-list></td>
                  <td><task-list :month="date.getMonth() + 1" :day="date.getDate()" :year="date.getFullYear()"></task-list></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div v-if="dayClicked">
        <subtask-editor :day="task.day" :month="task.month" :year="task.year"></subtask-editor>
        <center>
          <button class="btn btn-primary btn btn-block" @click="dayClicked = false"><i class="fa fa-calendar fa-2x"></i></button>
        </center>
      </div>
    </div>
  </div>
</template>

<script>
  import SubTaskEditor from './subtaskeditor.vue';
  import TaskList from './subtasks/TaskList.vue';
  import SubTaskList from './subtasks/SubTaskList.vue';

  export default {
    components: {
      'subtask-editor': SubTaskEditor,
      'task-list': TaskList,
      'subtask-list': SubTaskList,
    },

    data() {
      return {
        currentDate: {
          month: '',
          day: '',
          year: ''
        },

        days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

        //  due_date
        task: {
          day: '',
          month: '',
          year: ''
        },

        dayClicked: false,
        due_date: '',

        months: [
          'January', 'February', 'March', 'April', 'May', 'June',
          'July', 'August', 'September', 'October', 'November', 'December'
        ],

        dates: [],
      }
    },

    computed: {
      canPrev() {
        var today = new Date();

        if (this.currentDate.month > today.getMonth() + 1) {
          return true;
        }

        return false;
      },

      canNext() {
        var today = new Date();

        if (this.currentDate.month >= today.getMonth() + 1) {
          return true;
        }

        return false;
      }
    },

    methods: {
      changeDayClickStatus(date) {
        this.dayClicked = !this.dayClicked;

        this.task.day = date.getDate();
        this.task.month = date.getMonth() + 1;
        this.task.year = date.getFullYear();

        // window.events.$on('task-clicked', (e) => {
        //   this.task.id = e.task_id;
        //   this.task.day = e.day;
        //   this.task.month = e.month;
        //   this.task.year = e.year;
        // });
      },

      nextMonth() {
        if (this.currentDate.month == 12) {
          this.fetchCalendar(this.currentDate.year, this.currentDate.month = 1);
        } else {
          this.currentDate.month++;
          this.fetchCalendar(this.currentDate.year, this.currentDate.month);
        }
      },

      prevMonth() {
        if (this.currentDate.month == 1) {
          this.currentDate.month = 12;
        } else {
          this.currentDate.month--;
          this.fetchCalendar(this.currentDate.year, this.currentDate.month);
        }
      },

      fetchCalendar(year, month) {
        this.dates.splice(0, this.dates.length);

        var thisDay = {
          month: new Date().getMonth() + 1,
          year: new Date().getFullYear()
        };

        var beginDate = (year == thisDay.year) && (month == thisDay.month) ? new Date() : new Date(year, month - 1, 1);

        var endDate = new Date(year, month, 0);

        for (var date = beginDate; date < endDate; date.setDate(date.getDate() + 1)) {
          this.dates.push(new Date(date));
        }
        this.dates.push(new Date(endDate)); // '1 day offset' problem
      }
    },

    mounted() {
      var date = new Date();
      this.currentDate.month = date.getMonth() + 1;
      this.currentDate.day = date.getDate();
      this.currentDate.year = date.getFullYear();

      this.fetchCalendar(this.currentDate.year, this.currentDate.month);
    }
  }
</script>

<style scoped>
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
