<template>
  <div>
    <ul class="list-group">
      @foreach (auth()->user()->subtasks()->whereDate('due_date', \Carbon\Carbon::today())->get() as $subtask)
        <li class="list-group-item list-group-item-default">
          <i class="fa fa-circle-o" style="cursor: pointer" aria-hidden="true"></i>&nbsp;&nbsp;
          <strong><span style="font-size: 15px; color: red">
            {{ $subtask->task }}
          </span></strong>
            <span class="label label-info">{{ auth()->user()->tasks()->find($subtask->task_id)->title }}</span>
            <span class="label label-danger">
              {{ \App\Course::find(auth()->user()->tasks()->find($subtask->task_id)->course_id)->subject }}
              {{ \App\Course::find(auth()->user()->tasks()->find($subtask->task_id)->course_id)->course_number }}
            </span>
        </li>
      @endforeach
    </ul>
  </div>
</template>

<script>
  export default {

  }
</script>

<style scoped>
</style>
