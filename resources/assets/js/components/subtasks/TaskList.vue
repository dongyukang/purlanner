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
        tasksAllFromToday: [],
      }
    },

    computed: {
      tasks() {
        var tasksToSave = collect(this.tasksAllFromToday);

        var tasks = tasksToSave.filter((value, key) => {
          var date = new Date(value.due_date);
          date.setDate(date.getDate() + 1);

          return (date.getDate() == this.day) && (date.getFullYear() == this.year) && (date.getMonth() + 1 == this.month);
        });

        return tasks.all();
      }
    },

    methods: {
      fetchTasksFromToday() {
        axios.get('/tasksFromToday')
        .then(res => {
          this.tasksAllFromToday = res.data;
        });
      }
    },

    mounted() {
      this.fetchTasksFromToday();
    }
  }
</script>

<style scoped>
  li {
    color: red;
  }
</style>
