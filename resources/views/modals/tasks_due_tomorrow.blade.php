<div id="taskDueTomorrow" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Due Tomorrow</h4>
          </div>
          <div class="modal-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <td style="text-align: center">Course</td>
                  <td style="text-align: center">Task Type</td>
                  <td style="text-align: center">Title</td>
                  <td style="text-align: center"></td>
                </tr>
              </thead>
              <tbody>
                @foreach (auth()->user()->tasksDueTomorrow() as $task)
                  <tr>
                    <td style="text-align: center">{{ \App\Course::find($task->course_id)->subject . ' ' . \App\Course::find($task->course_id)->course_number }}</td>
                    <td style="text-align: center">{{ ucwords(strtolower($task->type)) }}</td>
                    <td style="text-align: center">{{ $task->title }}</td>
                    <td style="text-align: center">
                      <a class="btn btn-primary" href="/task/view/{{ $task->id }}">View</a>
                      <a class="btn btn-warning" href="/sub-task/active/{{ $task->id }}">Write Sub Tasks <span class="badge">{{ auth()->user()->subtasks()->where('task_id', $task->id)->whereDate('due_date', '>=', \Carbon\Carbon::today())->get()->count() }}</span></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
