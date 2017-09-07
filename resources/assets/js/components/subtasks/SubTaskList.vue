<template>
  <div>
    <ul v-for="todo in todos">
      <li>
        {{ todo.task }}
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    props: ['month', 'year' ,'day'],

    data() {
      return {
        subtasks: []
      }
    },

    computed: {
      todos() {
        var subtasksToSave = collect(this.subtasks);

        var subtasks = subtasksToSave.filter((value, key) => {
          var date = new Date(value.due_date);
          date.setDate(date.getDate() + 1);

          return (date.getDate() == this.day) && (date.getFullYear() == this.year) && (date.getMonth() + 1 == this.month);
        });

        return subtasks.all();
      }
    },

    methods: {
      fetchSubtasks() {
        axios.get('/subtasksFromToday')
        .then(res => {
          this.subtasks = res.data;
        });
      }
    },

    mounted() {
      this.fetchSubtasks();

      window.events.$on(
        'incoming-subtask', (data) => {
          // this.fetchSubtasks();
        }
      );
    }
  }
</script>

<style scoped>
</style>
