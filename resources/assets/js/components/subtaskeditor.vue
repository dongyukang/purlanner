<template>
  <div>
    <div class="container">
      <div class="jumbotron jumbotron-gradient">
        <form role="form" @submit.prevent="addSubTask()">
          <div class="row">
            <div class="col-xs-10">
              <input class="form-control" placeholder="What do you want to accomplish on this day?" v-model="subtask" required>
            </div>
            <div class="col-xs-2">
              <button type="submit" class="btn btn-danger">Save</button>
            </div>
          </div>
        </form>
      </div>

      <div>
        <table class="table table-striped">
          <thead>
            <tr>
              <td style="text-align: center">Day</td>
              <td style="text-align: center">Due/Event</td>
              <td style="text-align: center">Todo</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="text-align: center">{{ day }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['task_id', 'day', 'month', 'year'],

    computed: {
    },

    methods: {
      addSubTask() {
        flash('Subtask Successfully Added!');
      }
    },

    data() {
      return {
        subtask: ''
      }
    }
  }
</script>

<style scoped>
    /*style="background-color: #EDEFF5;*/
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
