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
        console.log(this.subtasks[0]); // subtasks for first task

        for (var i = 0; this.subtasks.length; i++) { // iterate through number of tasks
        }
      }
    },

    methods: {
      fetchSubtasks() {
        axios.get('/subtasksFromToday')
        .then(res => {
          this.subtasks = res.data;
          // this.subtasks = collect(res.data).pluck('subtasks').all();
        });
      }
    },

    mounted() {
      this.fetchSubtasks();
    }
  }
</script>

<style scoped>
</style>
