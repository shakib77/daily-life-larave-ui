@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">{{ __('All Tasks') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="container">
                            <div class="d-flex justify-content-between mb-3">
                                <h1>Tasks List</h1>
                                <button type="button" class="btn btn-success btn-sm" style="max-height: 30px"
                                        data-toggle="modal"
                                        data-target="#taskModal">
                                    Add Task
                                </button>
                            </div>


                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($tasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->date }}</td>
                                        <td>{{ $task->time }}</td>
                                        <td>{{ $task->description }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#taskModal" data-task-id="{{ $task->id }}">Edit
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                                    onclick="deleteTask({{ $task->id }})">Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No tasks found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                            {{-- todo: modal section starts--}}
                            <div class="modal fade" id="taskModal" tabindex="-1" role="dialog"
                                 aria-labelledby="taskModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="taskModalLabel">Add Task</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="taskForm" action="{{ route('tasks.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" id="taskId">
                                                <div class="form-group">
                                                    <label for="title">Title:</label>
                                                    <input type="text" class="form-control" id="title" name="title"
                                                           required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="date">Date:</label>
                                                    <input type="date" class="form-control" id="date" name="date"
                                                           required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="time">Time:</label>
                                                    <input type="time" class="form-control" id="time" name="time"
                                                           required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description:</label>
                                                    <textarea class="form-control" id="description"
                                                              name="description"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#taskModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var taskId = button.data('task-id');
                var modal = $(this);

                if (taskId) {
                    modal.find('.modal-title').text('Edit Task');
                    modal.find('#taskForm').attr('action', '{{ url('tasks') }}/' + taskId);
                    modal.find('#taskId').val(taskId);

                    $.ajax({
                        url: '{{ route('tasks.show', ['task' => ':taskId']) }}'.replace(':taskId', taskId),
                        type: 'GET',
                        success: function (response) {
                            modal.find('#title').val(response.data.title);
                            modal.find('#date').val(response.data.date);
                            modal.find('#time').val(response.data.time);
                            modal.find('#description').val(response.data.description);
                        },
                        error: function (error) {
                            console.error('Error fetching task details:', error);
                        }
                    });
                } else {
                    modal.find('.modal-title').text('Add Task');
                    modal.find('#taskForm').attr('action', '{{ route('tasks.store') }}');
                    modal.find('#taskId').val('');
                    modal.find('#taskForm')[0].reset();
                }
            });

            $('#taskForm').submit(function (event) {
                var form = $(this);

                // Check if any required field is empty
                if (form[0].checkValidity() === false) {
                    // Trigger the browser's default validation UI
                    form[0].reportValidity();
                    return;
                }

                event.preventDefault();
                var url = form.attr('action');
                var method = form.attr('method');

                $.ajax({
                    url: url,
                    type: method,
                    data: form.serialize(),
                    success: function (response) {
                        $('#taskModal').modal('hide');
                        location.reload();
                    },
                    error: function (error) {
                        console.error('Error submitting form:', error);
                    },
                    complete: function () {
                        // Enable the form and hide any loading indicators
                    }
                });
            });
        });

        function deleteTask(taskId) {
            if (confirm('Are you sure you want to delete this task?')) {
                $.ajax({
                    url: '{{ route('tasks.destroy', ['task' => ':taskId']) }}'.replace(':taskId', taskId),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        console.log('Task deleted successfully');
                        location.reload();
                    },
                    error: function (error) {
                        console.error('Error deleting task:', error);
                    }
                });
            }
        }
    </script>

@endpush
