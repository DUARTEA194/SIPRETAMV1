<!-- Page Heading -->
<script>
    var sessionVariable = <?php echo json_encode($_SESSION["RolUsuario"]); ?>;
</script>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Bienvenido al Dashboard</h1>
</div>
<?php if ($_SESSION['RolUsuario'] == "Administrador") : ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                lang: 'es',
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script>
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
        //console.log(Maquinas);

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

            events: {
                url: '/controllers/CalendarioController.php?option=listar'
            }, // Eventos para mostrar en el calendario
            eventClick: function(info) {
                //console.log(info.event);
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

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Usuarios</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalUsuarios">00</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Solictudes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalsolicitudes">00</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-plus fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Tiempo de uso</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalProductos">00</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Faltas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalVentas">00</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Registro de usuarios en los ultimos 7 diás</div>
                        </div>
                    </div>
                    <canvas id="NuevosUsuarios"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                solicitudes en los ultimos 7 diás</div>
                        </div>
                    </div>
                    <canvas id="NuevasSolicitudes"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12 col-mb-12 col-lg-5">
        <div class="card">
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>
        </div>
        <div class="col col-sm-12 col-mb-12 col-lg-7">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive-md">
                        <table class="table table-striped table-hover table-sm" style="width: 100%;" id="table_Solicitudes">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Status</th>
                                    <th scope="col">Fecha de registro</th>
                                    <th scope="col">Fecha Estimada</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Materia</th>
                                    <th scope="col">Tipo</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-900">
                            </tbody>
                        </table>
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
<?php endif; ?>