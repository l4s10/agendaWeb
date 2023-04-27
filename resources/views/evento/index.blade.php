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
                        <div class="mb-3 d-none">
                            <input type="hidden" name="id" id="id">
                        </div>
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
                            <input type="date" name="start" id="start" class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Help text</small>
                        </div>

                        <div class="mb-3">
                            <label for="end" class="form-label">End</label>
                            <input type="date" name="end" id="end" class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Help text</small>
                        </div>
                        <button type="submit" class="btn btn-success" id="btnGuardar">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-warning" id="btnModificar">Modificar</button>
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

        var formulario = document.querySelector("form");
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

            // Modifica la configuración de 'events' para usar axios
            events: function(fetchInfo, successCallback, failureCallback) {
                axios.get("{{ route('evento.data') }}")
                    .then(function(response) {
                        successCallback(response.data);
                    })
                    .catch(function(error) {
                        failureCallback(error);
                    });
            },

            dateClick:function(info){
                // Obtiene la fecha actual en formato de cadena
                var today = new Date().toLocaleDateString();
                // Establece la fecha actual como valor del campo "start" del formulario
                $("#start").val(today);
                $('#end').val(today);
                $("#evento").modal("show");
            },

            eventClick: function(info) {
                var evento_id = info.event.id;

                axios.get(`http://localhost:8000/eventos/${evento_id}/edit`)
                    .then(function(response) {
                        console.log(response);
                        $('#title').val(response.data.title);
                        $('#descripcion').val(response.data.descripcion);
                        $('#start').val(response.data.start);
                        $('#end').val(response.data.end);
                        $("#evento").modal("show");
                    })
                    .catch(function(error) {
                        // Maneja los errores de la petición
                        if(error.response){
                            console.log(error.response.data);
                        }
                    });
            },

        });

        calendar.render();

        document.getElementById("btnEliminar").addEventListener("click", function(){
            var evento_id = document.getElementById("id").value;

            axios.delete(`/eventos/${evento_id}`)
            .then(function(response) {
                // Cierra el modal
                $("#evento").modal("hide");

                // Refresca el calendario
                calendar.refetchEvents();
            })
            .catch(function(error) {
                // Maneja los errores de la petición
                if(error.response){
                    console.log(error.response.data);
                }
            });
        });

    });
</script>

@endsection
