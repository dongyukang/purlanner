<template>
  <div>
    <ul v-for="task in this.tasks">
      <li>
         {{ task.title }}
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    props: ['month', 'day', 'year'],

    data() {
      return {
        tasksAllFromToday: []
      }
    },

    computed: {
      tasks() {
        var tasks = []; // tasks that their due dates are equal to given day

        for (var t = 0; t < this.tasksAllFromToday.length; t++) {
          var date = new Date(this.tasksAllFromToday[t].due_date);
          date.setDate(date.getDate() + 1);

          if (date.getDate() == this.day && date.getFullYear() == this.year && date.getMonth() + 1 == this.month) {
            tasks.push(this.tasksAllFromToday[t]);
          }
        }

        return tasks;
      }
    },

    methods: {
      fetchTasksFromToday() {
        axios.get('/tasksFromToday')
        .then(res => {
          this.tasksAllFromToday = res.data;
        });
      },

      // emitStatus(task_id) {
      //   this.$emit('task-clicked');
      //
      //   window.events.$emit('task-clicked', {
      //     'task_id': task_id,
      //     'day': this.day,
      //     'month': this.month,
      //     'year': this.year
      //   });
      // }
    },

    mounted() {
      this.fetchTasksFromToday();
    }
  }
</script>

<style scoped>
</style>
