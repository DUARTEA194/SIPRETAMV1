if (sessionVariable == "Administrador") {
  document.addEventListener("DOMContentLoaded", function () {
    //ventas();
    clientes();
    totales();
    NuevosUsuarios();
    NuevasSolicitudes();
  });

  function totales() {
    axios
      .get("../../controllers/adminController.php?option=totales")
      .then(function (response) {
        const info = response.data;
        //console.log(info);
        document.querySelector("#totalUsuarios").textContent =
          info.usuario.total;
        document.querySelector("#totalsolicitudes").textContent =
          info.solicitud.total;
        //document.querySelector("#totaltiempo").textContent =
        //info.producto.total;
        //document.querySelector("#totalfaltas").textContent = info.venta.total;
      })
      .catch(function (error) {
        console.log(error);
      });
  }
  /*
  function ventas() {
    const dias = [
      "lunes",
      "martes",
      "miércoles",
      "jueves",
      "viernes",
      "sábado",
      "domingo",
    ];
  
    const ctx = document.getElementById("usuarios");
  
    axios
      .get("../../controllers/adminController.php?option=usuariosSemana")
      .then(function (response) {
        const info = response.data;
        //console.log(info);
        /*
        let fecha = [];
        let total = [];
        for (let i = 0; i < info.length; i++) {
          total.push(info[i]["total"]);
          const numeroDia = new Date(info[i]["fecha"]).getDay();
          const nombreDia = dias[numeroDia];
          fecha.push(nombreDia + " - " + info[i]["fecha"]);
        }
        new Chart(ctx, {
          type: "bar",
          data: {
            labels: fecha,
            datasets: [
              {
                label: "usuarios",
                data: total,
                borderWidth: 1,
              },
            ],
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
              },
            },
          },
        });
      })
      .catch(function (error) {
        console.log(error);
      });
  }*/
  function clientes() {
    const ctx = document.getElementById("topClientes");

    axios
      .get("../../controllers/adminController.php?option=topClientes")
      .then(function (response) {
        const info = response.data;
        let nombre = [];
        let total = [];
        for (let i = 0; i < info.length; i++) {
          nombre.push(info[i]["nombre"]);
          total.push(info[i]["total"]);
        }
        new Chart(ctx, {
          type: "bar",
          data: {
            labels: nombre,
            datasets: [
              {
                label: "Solicitudes",
                data: total,
                borderWidth: 1,
                backgroundColor: "#FFB1C1",
              },
            ],
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
              },
            },
          },
        });
      })
      .catch(function (error) {
        console.log(error);
      });
  }
  function NuevosUsuarios() {
    // Obtener el contexto del canvas
    var ctx = document.getElementById("NuevosUsuarios").getContext("2d");
    axios
      .get("controllers/adminController.php?option=usuariosSemana")
      .then(function (response) {
        const info = response.data;
        var fechasRegistro = [];
        var numerosUsuarios = [];

        // Iterar sobre el arreglo de objetos
        info.forEach(function (objeto) {
          // Obtener los valores del objeto
          var fechaRegistro = objeto.fecha_registro;
          var numeroUsuarios = objeto.numero_usuarios;

          // Almacenar los valores en los arreglos correspondientes
          fechasRegistro.push(fechaRegistro);
          numerosUsuarios.push(numeroUsuarios);
        });

        // Imprimir los arreglos resultantes
        console.log(fechasRegistro);
        console.log(numerosUsuarios);
        // Datos de la gráfica
        var data = {
          labels: fechasRegistro,
          datasets: [
            {
              label: "Nuevos usuarios",
              data: numerosUsuarios,
              backgroundColor: "rgba(54, 162, 235, 0.2)",
              borderColor: "rgba(54, 162, 235, 1)",
              borderWidth: 1,
              pointBackgroundColor: "rgba(54, 162, 235, 1)",
              pointBorderColor: "#fff",
              pointBorderWidth: 1,
              pointRadius: 5,
              pointHoverBackgroundColor: "#fff",
              pointHoverBorderColor: "rgba(54, 162, 235, 1)",
              pointHoverBorderWidth: 2,
              pointHitRadius: 10,
            },
          ],
        };
        // Opciones de la gráfica
        var options = {
          scales: {
            yAxes: [
              {
                ticks: {
                  beginAtZero: true,
                },
              },
            ],
          },
          legend: {
            display: false,
          },
          title: {
            display: true,
            text: "Nuevos usuarios en los últimos 7 días",
          },
        };

        // Crear la instancia de la gráfica
        var myChart = new Chart(ctx, {
          type: "line",
          data: data,
          options: options,
        });
      })
      .catch(function (error) {
        console.log(error);
      });
  }
  function NuevasSolicitudes() {
    // Obtener el contexto del canvas
    var ctx = document.getElementById("NuevasSolicitudes").getContext("2d");
    axios
      .get("/controllers/adminController.php?option=solictudesSemana")
      .then(function (response) {
        const info = response.data;
        console.log(info);
        var fechasRegistro = [];
        var numerosSolicitudes = [];

        // Iterar sobre el arreglo de objetos
        info.forEach(function (objeto) {
          // Obtener los valores del objeto
          var fechaRegistro = objeto.fecha_registro;
          var numeroSolicitudes = objeto.numero_solicitudes;

          // Almacenar los valores en los arreglos correspondientes
          fechasRegistro.push(fechaRegistro);
          numerosSolicitudes.push(numeroSolicitudes);
        });

        // Datos de la gráfica
        var data = {
          labels: fechasRegistro,
          datasets: [
            {
              label: "Nuevos usuarios",
              data: numerosSolicitudes,
              backgroundColor: "rgba(54, 162, 25, 0.2)",
              borderColor: "rgba(54, 162, 25, 1)",
              borderWidth: 1,
              pointBackgroundColor: "rgba(54, 162, 25, 1)",
              pointBorderColor: "#fff",
              pointBorderWidth: 1,
              pointRadius: 5,
              pointHoverBackgroundColor: "#fff",
              pointHoverBorderColor: "rgba(54, 162, 25, 1)",
              pointHoverBorderWidth: 2,
              pointHitRadius: 10,
            },
          ],
        };

        // Opciones de la gráfica
        var options = {
          scales: {
            yAxes: [
              {
                ticks: {
                  beginAtZero: true,
                },
              },
            ],
          },
          legend: {
            display: false,
          },
          title: {
            display: true,
            text: "Nuevos usuarios en los últimos 7 días",
          },
        };

        // Crear la instancia de la gráfica
        var myChart = new Chart(ctx, {
          type: "line",
          data: data,
          options: options,
        });
      })
      .catch(function (error) {
        console.log(error);
      });
  }
  document.addEventListener("DOMContentLoaded", function () {
    var dataTableConfig = {
      ajax: {
        url: "../../controllers/PrestamosController.php?option=listar",
        dataSrc: "",
      },
      columns: [
        { data: "status" },
        { data: "created_at" },
        { data: "Fecha_estimada" },
        { data: "TipoTrabajo" },
        { data: "Materia_id" },
        { data: "TipoTrabajo" },
      ],
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json",
      },
      order: [[0, "desc"]],
      dom: '<"row"<"col-md-12"t>>',
      scrollY: "320px",
      paging: false,
    };
    var table = $("#table_Solicitudes").DataTable(dataTableConfig);
  });
} else {
  document.addEventListener("DOMContentLoaded", function () {
    DashboardAlumno();
  });
  function DashboardAlumno() {
    var ContendorPrincipal = $(".container-fluid"); //Contenedor inicial
    axios
      .post("/controllers/PrestamosController.php?option=listarXalumno")
      .then(function (response) {
        Solicitudes = response.data;
        if (Solicitudes.length == 0) {
          var contenidoAlternativo = `
          <div class="text-center">
            <img class="mb-2" src="/assets/img/404.svg" alt="404" style="opacity: 0.6; width:90%;">
            <p><b>Parece que aún no hay solicitudes en la base de datos...</b></p>
          </div>
        `;
          ContendorPrincipal.html(contenidoAlternativo);
        } else {
          $.each(Solicitudes, function (i, Solicitud) {
            //console.log(Solicitud);
            // Crea un elemento HTML para la "card"
            var card = $("<div>")
              .addClass("card mb-3")
              .css(
                "box-shadow",
                "1px 2px 2px rgb(66 100 167 / 25%), 2px 4px 4px rgb(71 101 161 / 3%), 3px 6px 6px rgb(55 81 133 / 13%)"
              );

            // Agrega los datos correspondientes a la "card"
            var cardHeader = $("<div>")
              .addClass("card-header text-center p-1")
              .css("background-color", "#9c8520");
            var cardBody = $("<div>").addClass("card-body row");

            var titulo = $("<h5>")
              .addClass("font-weight-bold text-white")
              .text("Solicitud de prestamo");
            var divAcciones = $("<div>").addClass(
              "col-12 col-sm-12 col-mb-3 col-lg-3 text-center"
            );
            var divDatos = $("<div>").addClass(
              "col-12 col-sm-12 col-mb-3 col-lg-9"
            );

            // Crea el elemento de imagen
            var imagen = $("<img>")
              .attr("src", "/assets/img/Solicitud.png")
              .addClass("img-responsive")
              .css("width", "150");
            // Crea los botones
            var divBotonesAcciones = $("<div>").addClass("mt-4");
            var btnVerSolicitud = $("<button>")
              .addClass("btn btn-sm btn-primary mx-1")
              .text("Ver Solicitud")
              .attr("id", "btnVerSolicitud")
              .attr("data-id", Solicitud.idSolicitud)
              .click(function () {
                var idSolicitud = $(this).data("id");
                //alert("Ver solictud: " + idSolicitud);
                window.location =
                  "plantilla.php?pagina=reporte&sale=" + idSolicitud;
              });

            divBotonesAcciones.append(btnVerSolicitud);
            divAcciones.append(imagen, divBotonesAcciones);

            // Crea el div adicional para el contenido del cuerpo
            divDatos.html(`
        <div class="form-row">
          <input type="hidden" name="InputIdSolicitud" id="InputIdSolicitud">
          <div class="form-group col-md-6">
            <label>Fecha:</label>
            <label type="date" name="InputFecha" class="form-control form-control-sm text-gray-900" id="InputFecha"></label>
          </div>
          <div class="form-group col-md-6">
            <label>Hora:</label>
            <label name="InputHora" class="form-control form-control-sm text-gray-900" id="InputHora"></label>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label for="InputMateria" class="control-label">Materia:</label>
            <select class="form-control form-control-sm text-gray-900" id="SelectMateria" name="SelectMateria" disabled>
                <option value="" selected hidden>Seleccione una materia</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="InputTipoTrabajo" class="control-label">Tipo de trabajo</label>
            <select class="form-control form-control-sm text-gray-900" id="InputTipoTrabajo" name="InputTipoTrabajo" disabled>
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
            <textarea class="form-control text-gray-900" placeholder="Descripcion del trabajo a realizar" name="InputDescripcion" id="InputDescripcion" disabled></textarea>
          </div>
      </div>
      `);
            divDatos.find("#InputFecha").text(Solicitud.Fecha_estimada);
            divDatos.find("#InputHora").text(Solicitud.Hora_estimada);
            divDatos.find("#SelectMateria").val(Solicitud.Materia_id);
            divDatos.find("#InputTipoTrabajo").val(Solicitud.TipoTrabajo);
            divDatos.find("#InputDescripcion").val(Solicitud.Descripcion);

            // Agrega los elementos al contenedor de la "card"
            cardHeader.append(titulo);
            cardBody.append(divAcciones, divDatos);
            card.append(cardHeader, cardBody);

            // Agrega la "card" al contenedor principal
            ContendorPrincipal.append(card);
          });
        }
      })
      .catch(function (error) {
        console.log(error);
      });
  }
}
