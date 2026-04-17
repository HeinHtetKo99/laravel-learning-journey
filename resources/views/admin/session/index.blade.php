@extends('admin.layouts.app')

@section('title', 'Task Management')

@section('style')

@section('header', 'Task Management')

@section('content')
    <div class="mb-3">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="mb-3">
                    <button class="btn btn-primary" id="create-action">
                        <i class="bi bi-plus-circle-fill me-1">
                            Create
                        </i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <lael class="form-label">Task</lael>
                    <input type="text" id="task" class="form-control">
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <lael class="form-label">Description</lael>
                    <input type="text" id="description" class="form-control">
                </div>
            </div>

            <div class="col-md-12">
                <button class="btn btn-primary" id="save-task">
                    <i class="bi bi-plus-circle-dotted" id="action-icon"></i>
                    <span id="action-label">Save</span>
                </button>
            </div>
        </div>
    </div>

    <hr>

    <div class="row mb-3 tasks">
        @foreach($tasks as $task)
            <div class="col-md-6 mb-3">
                <div class="card" style="width:100%;">
                    <div class="card-body">
                        <h5 class="card=subtitle mb-2 text-body-secondary">{{ $task['task']}}</h5>
                        <p class="card-text">{{ $task['description']}}</p>
                        <button class="btn btn-success edit-task" data-id="{{ $task['id'] }}">
                            <i class="bi bi-pencil-fill"></i>
                            Edit
                        </button>
                        <button class="btn btn-danger delete-task" data-id="{{ $task['id'] }}">
                            <i class="bi bi-trash"></i>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            let actionState = "create"
            $('#task').focus()
            $('#create-action').click(()=>{
                $('#task').val('')
                $('#description').val('')
                $('#task').focus()
                actionState = "create"
                $('#action-icon').attr('class','bi bi-plus-circle-dotted')
                $('#save-task').attr('class','btn btn-primary')
                $('#action-label').html('Save')
            })
            $('#save-task').click(() => {
                const task = $('#task').val();
                const description = $('#description').val()
                if (!task) {
                    alert('Please enter task.')
                    $('#task').focus()
                }
                else if (!description) {
                    alert('Please enter description.')
                    $('#description').focus()
                }
                if(actionState == 'create'){
                    $.ajax({
                    url: "/admin/session/tasks",
                    type: 'POST',
                    data: {
                        task: task,
                        description: description,
                        _token: '{{ csrf_token() }}'
                    },
                    success: (response) => {
                        const tasks = response.data
                        loadTasks(tasks)

                        //clear fields
                        $('#task').val('')
                        $('#description').val('')
                        $('#task').focus()
                    },
                });
                }
                else{
                    alert('edit')
                }
            })

            //for edit
            $(document).on('click', '.edit-task', (e) => {
                const button = $(e.currentTarget)
                const taskId = button.data("id")
                
                const task = button.parent().children().eq(0).html()
                const description = button.parent().children().eq(1).html()
                
                $('#task').val(task)
                $('#description').val(description)
                $('#action-label').html('Edit')
                $('#action-icon').attr('class','bi bi-pencil-fill')
                $('#save-task').attr('class','btn btn-success edit-task')
                actionState = "Edit"

            })

            //for delete dynamic 
            $(document).on('click', '.delete-task', (e) => {
                const button = $(e.currentTarget)
                const taskId = button.data("id")
                deleteTask(taskId).then((response) => {
                    const tasks = response
                    loadTasks(tasks)
                })
            })

            const deleteTask = async (taskId) => {
                const response = await fetch('/admin/session/tasks/' + taskId, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF_TOKEN': '{{ csrf_token() }}'
                    }
                })
                return response.json()
            }

            const loadTasks = (tasks) => {
                //empty tasks
                $('.tasks').empty()

                //update tasks
                tasks.forEach(task => {
                    const _task = `
                                <div class="col-md-6 mb-3">
                                    <div class="card" style="width:100%;">
                                        <div class="card-body">
                                            <h5 class="card=subtitle mb-2 text-body-secondary">${task.task}</h5>
                                            <p class="card-text">${task.description}</p>
                                            <button class="btn btn-success edit-task" data-id ="${task.id}">
                                                <i class="bi bi-pencil-fill"></i>
                                                Edit
                                            </button>
                                            <button class="btn btn-danger delete-task" data-id="${task.id}">
                                                <i class="bi bi-trash"></i>
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            `
                    $('.tasks').append(_task)
                });
            }
        })
    </script>
@endsection