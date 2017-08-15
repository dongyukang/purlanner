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
        todos_data: []
      }
    },

    computed: {
      todos() {
        var todos = [];

        for (var t = 0; t < this.todos_data.length; t++) {
          var date = new Date(this.todos_data[t].due_date);
          date.setDate(date.getDate() + 1);

          if (date.getDate() == this.day && date.getFullYear() == this.year && date.getMonth() + 1 == this.month) {
            todos.push(this.todos_data[t]);
          }
        }

        return todos;
      }
    },

    mounted() {
      axios.get('/subtasksByTask/')
      .then(res => {
        this.todos_data = res.data;
      });
    }
  }
</script>

<style scoped>
</style>
