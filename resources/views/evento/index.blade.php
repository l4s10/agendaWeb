@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="calendar"></div>
    </div>

    @can('ver boton')
        <!-- Modal trigger button -->
    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#evento">
        Launch
    </button>
    @endcan

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="evento" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-mg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('eventos.store')}}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Titulo</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Ingrese titulo de evento" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Help text</small>
                        </div>


                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="start" class="form-label">Start</label>
                            <input type="text" name="start" id="start" class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Help text</small>
                        </div>

                        <div class="mb-3">
                            <label for="end" class="form-label">End</label>
                            <input type="text" name="end" id="end" class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Help text</small>
                        </div>
                        <button type="submit" class="btn btn-success" id="btnGuardar">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-warning" id="btnModificar">Modificar</button>
                    <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)

    </script>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        let formulario = document.querySelector("form");
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: "es",
            firstDay: 1,

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },

            // Añade la configuración para cargar eventos desde Laravel
            events: "{{ route('evento.data') }}",

            dateClick:function(info){
                $("#evento").modal("show");
            },
        });

        calendar.render();
    });
</script>
@endsection
