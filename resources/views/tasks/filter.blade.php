@foreach ($types as $type)
  <div class="col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center">
        <h4> {{ ucwords(strtolower($type)) }} <span class="badge"> {{ auth()->user()->countTask($type, $course_id) }} </span></h4>
      </div>
      <div class="panel-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <td style="text-align: center">Course</td>
              <td style="text-align: center">Title</td>
              <td style="text-align: center">Due Date</td>
              <td style="text-align: center"></td>
            </tr>
          </thead>
          <tbody>
            @foreach (auth()->user()->tasks()->where('type', $type)->where('course_id', $course_id)->whereDate('due_date', '>=', \Carbon\Carbon::parse(date("m/d/Y")))->orderBy('due_date', 'asc')->get() as $task)
              <tr>
                <td style="text-align: center">{{ \App\Course::find($course_id)->subject . ' ' . \App\Course::find($course_id)->course_number }}</td>
                <td style="text-align: center">{{ $task->title }}</td>
                <td style="text-align: center">{{ $task->due_date }}</td>
                <td style="text-align: center">
                  <a class="btn btn-primary" href="/task/view/{{ $task->id }}">View</a>
                  <a class="btn btn-warning" href="/sub-task/active/{{ $task->id }}">Write Sub Tasks <span class="badge">{{ auth()->user()->subtasks()->where('task_id', $task->id)->whereDate('due_date', '>=', \Carbon\Carbon::today())->get()->count() }}</span></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endforeach
