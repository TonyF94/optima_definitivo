@extends('system.app')

@section('content')

    <div class="row mt-5">
        <div class="col-12">
            {{-- <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-12 align-items-center text-center">
                        <h1 class="mb-0">Task Management System by Optima Task Team</h1>
                    </div>
                </div>

                @if ($errors->any())
                <div class="row mt-3 justify-content-center">
                    <div class="col-6">
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger text-white" role="alert">
                            <strong>Error!</strong> {{ $error }}
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif


            </div>
            <div class="card-body p-3 pb-0">

            </div>
        </div> --}}
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-8">

            <div class="card">
                <div class="card-body pb-0 p-3 ">

                    <div class="row">

                        <div class="col-12 d-flex align-items-center justify-content-center">

                            <h3 class="mb-0">Tasks</h6>

                        </div>

                        <div class="col-12 d-flex align-items-center justify-content-center pt-3">
                            <button type="button" class="btnmy-auto btn bg-gradient-primary  mt-2" data-bs-toggle="modal"
                                data-bs-target="#add-new-task"><i class="fas fa-plus"
                                    aria-hidden="true"></i>&nbsp;&nbsp;Aggiungi Task</button>
                        </div>

                    </div>

                </div>

                <div class="card-body pt-4 p-3">

                    <form action="{{ route('home.index') }}" method="get">
                        <div class="row mt-2 mb-2">
                            @csrf
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="filter-form-task-project" class="form-control-label">Project</label>
                                    <select name="projectFilter" class="form-control" id="filter-form-task-project">
                                        <option value="all">All</option>
                                        @foreach ($projects as $project)
                                            <option {{ $projectFilter == $project->id ? 'selected' : '' }}
                                                value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="filter-form-task-status" class="form-control-label">Status</label>
                                    <select name="statusFilter" class="form-control" id="filter-form-task-status">
                                        <option {{ $statusFilter == 'all' ? 'selected' : '' }} value="all">All</option>
                                        <option {{ $statusFilter == 'completed' ? 'selected' : '' }} value="completed">
                                            Completato</option>
                                        <option {{ $statusFilter == 'incomplete' ? 'selected' : '' }} value="incomplete">
                                            Da completare</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 my-auto">
                                <button type="submit" class="my-auto btn bg-gradient-primary mt-2"><i class="fas fa-search"
                                        aria-hidden="true"></i>&nbsp;&nbsp;Filtri</button>


                                <a href="{{ route('home.index') }}" class="my-auto btn bg-gradient-warning mt-2"><i
                                        class="fas fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Resetta Filtro</a>

                            </div>
                        </div>
                    </form>


                    <ul class="list-group">


                        @if (count($tasks) > 0)
                            @foreach ($tasks as $task)
                                <li class="list-group-item border-1 p-4 mb-2 bg-gray-100 border-radius-lg task-item"
                                    data-task-id="{{ $task->id }}"
                                    style="border-left: 10px solid {{ $task->project_color }}!important; border-radius: 0 10px 10px 0!important; {{ $task->is_completed ? 'opacity: 0.5; text-decoration: line-through;' : '' }}">
                                    <div class="row">
                                        <div class="col-9 my-auto">
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-3 text-sm">{{ $task->name }}</h6>
                                                <span class="mb-2 text-xs">Nome progetto: <span
                                                        class="text-dark font-weight-bold ms-sm-2">{{ $task->project_name }}</span></span>
                                                <span class="mb-2 text-xs">Stato:
                                                    @if ($task->is_completed)
                                                        <span class="badge badge-sm bg-gradient-success">COMPLETATO</span>
                                                    @else
                                                        <span class="badge badge-sm bg-gradient-warning">DA COMPLETARE</span>
                                                    @endif
                                                </span>
                                                <span class="text-xs">Segna come completato:
                                                    <span class="text-dark ms-sm-2 font-weight-bold">
                                                        <input type="checkbox" class="toggle-completion"
                                                            data-task-id="{{ $task->id }}"
                                                            {{ $task->is_completed ? 'checked' : '' }}>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-3 my-auto">
                                            <div class="ms-auto text-end">
                                                <button class="btn btn-link text-dark px-3 mb-0" data-bs-toggle="modal"
                                                    data-bs-target="#edit-task-id-{{ $task->id }}"><i
                                                        class="fas fa-pencil-alt text-dark me-2"
                                                        aria-hidden="true"></i>Modifica</button>
                                                <button class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#delete-task-id-{{ $task->id }}"><i
                                                        class="far fa-trash-alt me-2"
                                                        aria-hidden="true"></i>Cancella</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>


                                <div class="modal fade" id="edit-task-id-{{ $task->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="edit-task-id-{{ $task->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="modal-title-default">Modifica Task</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('tasks.update', ['id' => $task->id]) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="edit-task-form-task-name"
                                                                    class="form-control-label">Nome Task</label>
                                                                <input class="form-control" id="edit-task-form-task-name"
                                                                    name="name" type="text"
                                                                    value="{{ $task->name }}" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="edit-task-form-task-project"
                                                                    class="form-control-label">Progetto</label>
                                                                <select name="project" class="form-control"
                                                                    id="edit-task-form-task-project">
                                                                    @foreach ($projects as $project)
                                                                        <option
                                                                            {{ $project->id == $task->project ? 'selected' : '' }}
                                                                            value="{{ $project->id }}">
                                                                            {{ $project->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn bg-gradient-primary">Salva
                                                        cambiamenti</button>
                                                    <button type="button" class="btn btn-link  ml-auto"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="delete-task-id-{{ $task->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="delete-task-id-{{ $task->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="modal-title-notification">È richiesta la tua
                                                    attenzione</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="py-3 text-center">
                                                    <i style="font-size: 35px!important;"
                                                        class="far fa-trash-alt text-gradient text-danger"></i>
                                                    <h4 class="text-gradient text-danger mt-4">Sei sicuro che vuoi
                                                        cancellarlo?</h4>
                                                    <p>Sei sicuro che vuoi eliminare questa task?</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ route('tasks.delete', ['id' => $task->id]) }}"
                                                    class="btn btn-danger">Si, Cancella</a>
                                                <button type="button" class="btn btn-link text-muted ml-auto"
                                                    data-bs-dismiss="modal">Chiudi</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row mt-5">
                                <div class="col-12 text-center">

                                    <i style="font-size: 40px" class="fa fa-warning text-muted"></i>

                                    <h4 class="text-muted mt-2">Nessuna task al momento! Prova ad aggiungerne una nuova!
                                    </h4>

                                </div>
                            </div>
                        @endif

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center d-flex flex-column ">
                            <h4 class="mb-0 mx-4">Progetti</h4>
                            {{-- </div> --}}
                            {{-- <div class="col-6 align-items-end text-end"> --}}
                            <button type="button" class="btn btn-sm bg-gradient-primary mb-0 mt-3" data-bs-toggle="modal"
                                data-bs-target="#add-new-project"><i class="fas fa-plus"
                                    aria-hidden="true"></i>&nbsp;&nbsp;Aggiungi un progetto</button>
                            {{-- </div> --}}
                        </div>
                    </div>

                </div>
                <div class="card-body p-3 pb-0">

                    @if (count($projects) > 0)
                        <ul class="list-group">

                            @foreach ($projects as $project)
                                <li class="list-group-item border-1 p-2 mb-2 bg-gray-100 border-radius-lg"
                                    style="border-left: 10px solid {{ $project->color }}!important;border-radius: 0 10px 10px 0!important;">
                                    <div class="row">
                                        <div class="col-7 my-auto">
                                            <div class="d-flex flex-column">
                                                <h6 class="text-sm my-auto">{{ $project->name }}</h6>
                                            </div>
                                        </div>
                                        <div class="ms-auto col-5">
                                            <div class="text-end">
                                                <button class="btn btn-link text-dark px-3 mb-0" data-bs-toggle="modal"
                                                    data-bs-target="#edit-project-id-{{ $project->id }}"><i
                                                        class="fas fa-pencil-alt text-dark me-2"
                                                        aria-hidden="true"></i>Edit</button>
                                                <button class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#delete-project-id-{{ $project->id }}"><i
                                                        class="far fa-trash-alt me-2"
                                                        aria-hidden="true"></i>Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>


                                <div class="modal fade" id="edit-project-id-{{ $project->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="edit-project-id-{{ $project->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="modal-title-default">Edit Project</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('projects.update', ['id' => $project->id]) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="edit-project-form-project-name"
                                                                    class="form-control-label">Nome Progetto</label>
                                                                <input class="form-control"
                                                                    id="edit-project-form-project-name" name="name"
                                                                    type="text" value="{{ $project->name }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="edit-project-form-project-color"
                                                                    class="form-control-label">Colore Progetto</label>
                                                                <input class="form-control" type="color"
                                                                    id="edit-project-form-project-color" name="color"
                                                                    value="{{ $project->color }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn bg-gradient-primary">Salva
                                                        Cambiamenti</button>
                                                    <button type="button" class="btn btn-link  ml-auto"
                                                        data-bs-dismiss="modal">Chiudi</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="delete-project-id-{{ $project->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="delete-project-id-{{ $project->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="modal-title-notification">Your attention is
                                                    required</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="py-3 text-center">
                                                    <i style="font-size: 35px!important;"
                                                        class="far fa-trash-alt text-gradient text-danger"></i>
                                                    <h4 class="text-gradient text-danger mt-4">Sei sicuro che vuoi
                                                        cancellarlo?</h4>
                                                    <p>Sei sicuro di voler eliminare questo progetto? Le task che dipendono
                                                        da esso saranno anch'esse eliminate.</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ route('projects.delete', ['id' => $project->id]) }}"
                                                    class="btn btn-danger">Si, Cancella</a>
                                                <button type="button" class="btn btn-link text-muted ml-auto"
                                                    data-bs-dismiss="modal">Chiudi</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </ul>
                    @else
                        <div class="row mt-5">
                            <div class="col-12 text-center">

                                <i style="font-size: 40px" class="fa fa-warning text-muted"></i>

                                <h4 class="text-muted mt-2">Nessun progetto allegato al momento! Prova ad aggiungerne uno
                                    nuovo.</h4>

                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </div>

    </div>





    {{-- MODALS --}}


    {{-- ADD NEW PROJECT --}}
    <div class="modal fade" id="add-new-project" tabindex="-1" role="dialog" aria-labelledby="add-new-project"
        aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Aggiungi un nuovo progetto</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('projects.insert') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add-project-form-project-name" class="form-control-label">Nome
                                        Progetto</label>
                                    <input class="form-control" id="add-project-form-project-name" name="name"
                                        type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add-project-form-project-color" class="form-control-label">Colore
                                        Progetto</label>
                                    <input class="form-control" type="color" id="add-project-form-project-color"
                                        name="color" value="#636e72">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-primary">Salva cambiamenti</button>
                        <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Chiudi</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- ADD NEW TASK --}}
    <div class="modal fade" id="add-new-task" tabindex="-1" role="dialog" aria-labelledby="add-new-task"
        aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Aggiungi nuovo progetto</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('tasks.insert') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add-task-form-task-name" class="form-control-label">Nome Task</label>
                                    <input class="form-control" id="add-task-form-task-name" name="name"
                                        type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="add-task-form-task-project" class="form-control-label">Progetto</label>
                                    <select name="project" class="form-control" id="add-task-form-task-project">
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-primary">Salva cambiamenti</button>
                        <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Chiudi</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection


@section('extraScript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const incompleteCount = {{ $incompleteTasksCount }};

            if (incompleteCount > 0) {
                //permesso per le notifiche
                if (Notification.permission === "granted") {
                    // Se autorizzato, mostra notifica
                    new Notification("Hai " + incompleteCount + " task non completate!");
                } else if (Notification.permission !== "denied") {
                    // Se non viene negato, chiedi permesso
                    Notification.requestPermission().then(permission => {
                        if (permission === "granted") {
                            new Notification("Hai " + incompleteCount + " task non completate!");
                        }
                    });
                }
            }
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.toggle-completion').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const isCompleted = this.checked;
                    const taskId = this.dataset.taskId;

                    // Mostra una notifica solo per il task selezionato
                    if (Notification.permission === "granted") {
                        new Notification(isCompleted ? "Task completata!" :
                            "Task segnata come non completata.");
                    } else if (Notification.permission !== "denied") {
                        Notification.requestPermission().then(permission => {
                            if (permission === "granted") {
                                new Notification(isCompleted ? "Task completata!" :
                                    "Task segnata come non completata.");
                            }
                        });
                    }

                    // Aggiungi un ritardo
                    setTimeout(function() {
                        location
                            .reload();
                    }, 1500);
                });
            });
        });
    </script>



    <script>
        $(document).ready(function() {


            $('.toggle-completion').change(function() {
                var taskId = $(this).data('task-id');
                var isChecked = $(this).is(':checked');
                var listItem = $(this).closest('li');

                $.ajax({
                    url: '<?php echo route('tasks.toggleCompletion'); ?>' + "/" + taskId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.is_completed) {
                                listItem.css({
                                    'opacity': '0.5',
                                    'text-decoration': 'line-through'
                                });
                                listItem.find('.badge').removeClass('bg-gradient-warning')
                                    .addClass('bg-gradient-success').text('COMPLETED');
                                iziToast.success({
                                    title: 'Operazione riuscita',
                                    message: 'Task contrassegnato come completato.',
                                    position: 'topRight'
                                });
                            } else {
                                listItem.css({
                                    'opacity': '1',
                                    'text-decoration': 'none'
                                });
                                listItem.find('.badge').removeClass('bg-gradient-success')
                                    .addClass('bg-gradient-warning').text('INCOMPLETE');
                                iziToast.success({
                                    title: 'Operazione riuscita',
                                    message: 'Task contrassegnato come non completato.',
                                    position: 'topRight'
                                });
                            }
                        } else {
                            iziToast.error({
                                title: 'Errore',
                                message: 'Si è verificato un errore durante l\'aggiornamento dello stato del task.',
                                position: 'topRight'
                            });
                        }
                    },
                    error: function(xhr) {
                        iziToast.error({
                            title: 'Errore',
                            message: 'Si è verificato un errore durante l\'aggiornamento dello stato del task.',
                            position: 'topRight'
                        });
                    }
                });
            });

            // Drag and drop işlemi için sortable'ı etkinleştirme
            var el = document.querySelector('.list-group');
            var sortable = Sortable.create(el, {
                animation: 150,
                onEnd: function(evt) {
                    var taskOrder = [];
                    $('.task-item').each(function(index, element) {
                        taskOrder.push($(element).data('task-id'));
                    });

                    $.ajax({
                        url: '<?php echo route('tasks.updatePriority'); ?>',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            taskOrder: taskOrder
                        },
                        success: function(response) {
                            if (response.success) {
                                iziToast.success({
                                    title: 'Operazione riuscita',
                                    message: 'Ordine del task aggiornato.',
                                    position: 'topRight'
                                });
                            } else {
                                iziToast.error({
                                    title: 'Errore',
                                    message: 'Si è verificato un errore durante l\'aggiornamento della sequenza dei task.',
                                    position: 'topRight'
                                });
                            }
                        },
                        error: function(xhr) {
                            iziToast.error({
                                title: 'Errore',
                                message: 'Si è verificato un errore durante l\'aggiornamento della sequenza dei task.',
                                position: 'topRight'
                            });
                        }
                    });
                }
            });




        });
    </script>
@endsection
