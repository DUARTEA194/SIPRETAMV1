<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        //Mapeo de las materias, maquinas y herramientas
        axios
    .all([
      axios.get("../../controllers/MaquinasController.php?option=listar"),
      axios.get("../../controllers/HerramientasController.php?option=listar"),
      axios.get("../../controllers/MateriasController.php?option=listar"),
    ])
    .then(
      axios.spread(function (response1, response2, response3) {
        Maquinas = response1.data;
        Herramientas = response2.data;
        Materias = response3.data;

        var SelectMaquina = $("#SelectMaquina");
        var SelectHerramienta = $("#SelectHerramienta");
        var SelectMateria = $("#SelectMateria");
        console.log(Maquinas);

        $.each(Maquinas, function (i, Maquina) {
          SelectMaquina.append(
            '<option value="' +
              Maquina.idMaquina +
              '">' +
              Maquina.NombreMaquina +
              "</option>"
          );
        });

        $.each(Herramientas, function (i, Herramienta) {
          SelectHerramienta.append(
            '<option value="' +
              Herramienta.idHerramienta +
              '">' +
              Herramienta.NombreHerramienta +
              "</option>"
          );
        });

        $.each(Materias, function (i, Materia) {
          SelectMateria.append(
            '<option value="' +
              Materia.IdMateria +
              '">' +
              Materia.Grupo +
              " - " +
              Materia.NombreMateria +
              " - " +
              Materia.Profesor +
              "</option>"
          );
        });
      })
    );
        //Fin del mapeo de las materias,maquinas y herramientas

        var calendar = new FullCalendar.Calendar(calendarEl, {
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            locale: 'es', // Configura el idioma en español
            initialView: 'dayGridMonth', // Mostrar vista de mes al inicio
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            }, // Barra de herramientas para cambiar de vista

            events: {
                url: '/controllers/CalendarioController.php?option=listar'
            }, // Eventos para mostrar en el calendario
            eventClick: function(info) {
                console.log(info.event);
                $("#eventStatus").css("background-color", info.event.backgroundColor);
                $('#eventTitle').text("Solicitud " + info.event.title);
                $("#InputFecha").val(info.event.extendedProps.Fecha_estimada);
                $("#InputHora").val(info.event.extendedProps.Hora_estimada);
                $("#SelectMateria").val(info.event.extendedProps.Materia_id);
                $("#InputTipoTrabajo").val(info.event.extendedProps.TipoTrabajo);
                $("#InputDescripcion").val(info.event.extendedProps.Descripcion);
                // abre el modal
                var eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
                $("#eventModal").find("select,input,textarea").prop("disabled", true);
                eventModal.show();
            }
        });

        calendar.render();
    });
</script>
<div class="card mb-5">
    <div class="card-body">
        <h4 class="text-center">Calendario de solicitudes</h4>
        <div class="row">
            <div class="col-md-3 d-none d-md-block">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-4">Informacion de las solicitudes</h6>
                        <div id="external-events" class="external-events">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header p-1" id="headingFive">
                                        <button class="btn btn-link btn-block text-left collapsed text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            <h5 class="text-dark"><i class="fas fa-circle text-primary"></i> Solicitud</h5>
                                        </button>
                                    </div>
                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <p class="text-justify">
                                                El usuario ha realizado la solicitud de un préstamo, pero aún no ha sido aprobada ni rechazada.
                                            </p>
                                            <p class="text-justify">
                                                En esta etapa, el personal encargado puede revisar la información dada y decidir si aprueba o rechaza la solicitud.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header p-1" id="headingOne">
                                        <button class="btn btn-link btn-block text-left collapsed text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            <h5 class="text-dark"><i class="fas fa-circle text-info"></i> Activa</h5>
                                        </button>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <p class="text-justify">
                                                Cuando una solicitud ha sido aprobada, se considera como "activa".
                                            </p>
                                            <p class="text-justify">
                                                Esto significa que el usuario tiene el permiso para utilizar las herramientas y/o maquinas solicitadas durante el tiempo estipulado.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header p-1" id="headingTwo">
                                        <button class="btn btn-link btn-block text-left collapsed text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <h5 class="text-dark"><i class="fas fa-circle text-danger"></i> Falta</h5>
                                        </button>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <p class="text-justify">
                                                Si el usuario no cumple con las condiciones acordadas para el préstamo, la solicitud puede ser puesta en estado de "falta".
                                            </p>
                                            <p class="text-justify ">
                                                <b>Por ejemplo, si el usuario no devuelve las herramientas o maquinas a tiempo o si son devueltas en mal estado, la solicitud puede ser marcada como "falta".</b>
                                            </p>
                                            <p class="text-justify">
                                                En esta etapa, se pueden tomar medidas para resolver la situación, como contactar al usuario para informarle de la falta o tomar medidas para recuperar las herramientas o maquinarias.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header p-1" id="headingThree">
                                        <button class="btn btn-link btn-block text-left collapsed text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <h5 class="text-dark"><i class="fas fa-circle text-warning"></i> Cancelada</h5>
                                        </button>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <p class="text-justify">Si por alguna razón se decide cancelar la solicitud antes de que se complete el préstamo, se puede poner en estado de "cancelada".</p>
                                            <p class="text-justify">Esto puede suceder si el usuario decide cancelar la solicitud, si se descubre información falsa en la solicitud o si las herramientas o maquinas solicitadas ya no están disponibles.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header p-1" id="headingFour">
                                        <button class="btn btn-link btn-block text-left collapsed text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            <h5 class="text-dark"><i class="fas fa-circle text-success"></i> Completada</h5>
                                        </button>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <p class="text-justify">Cuando el usuario devuelve las herramientas o maquinas en buen estado y se cumple con los términos acordados para el préstamo, la solicitud se considera como "completada". </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- MODAL-->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header p-2" id="eventStatus">
                <h5 id="eventTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Fecha:</label>
                        <input type="date" name="InputFecha" class="form-control form-control-sm text-gray-900" id="InputFecha" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Hora de inicio:</label>
                        <input type="time" name="InputHora" class="form-control form-control-sm text-gray-900" id="InputHora" value="">
                    </div>
                </div>
                <?php if ($_SESSION['RolUsuario'] == "Administrador") : ?>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="InputMateria" class="control-label">Materia:</label>
                        <select class="form-control form-control-sm text-gray-900" id="SelectMateria" name="SelectMateria">
                            <option value="" selected hidden>Seleccione una materia</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="InputTipoTrabajo" class="control-label">Tipo de trabajo</label>
                        <select class="form-control form-control-sm text-gray-900" id="InputTipoTrabajo" name="InputTipoTrabajo">
                            <option value="" class="OpcionGenerica" selected hidden>Seleccione un tipo de trabajo</option>
                            <option value="1">Tesis</option>
                            <option value="2">Proyecto de asignatura</option>
                            <option value="3">Investigacion</option>
                            <option value="4">Capitulo estudiantil</option>
                            <option value="5">Trabajo externo</option>
                            <option value="0">Otro</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <textarea class="form-control text-gray-900" placeholder="Descripcion del trabajo a realizar" name="InputDescripcion" id="InputDescripcion" style="height: 100px;"></textarea>
                    </div>
                </div>
                <?php endif; ?>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>