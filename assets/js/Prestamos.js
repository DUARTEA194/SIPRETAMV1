var Maquinas;
var Herramientas;
var Materias;
var tablaSolicitudes;
function EstablecerTabla() {
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
      { data: "Acciones" },
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json",
    },
    order: [[1, "desc"]],
    dom: '<"row"<"col-md-6"B><"col-md-6"f>>' + '<"row"<"col-md-12"t>>',
    scrollY: "320px",
    paging: false,
    buttons: [
      {
        extend: "excel",
        className: "btn btn-sm",
        text: "Excel",
      },
      {
        extend: "pdf",
        className: "btn btn-sm",
        text: "PDF",
      },
      {
        extend: "csv",
        className: "btn btn-sm",
        text: "CSV",
      },
      {
        extend: "print",
        className: "btn btn-sm",
        text: "print",
      },
    ],
  };

  // Inicializar DataTables
  tablaSolicitudes = $("#table_Solicitudes").DataTable(dataTableConfig);
}
//Carga de los datos de solictudes
document.addEventListener("DOMContentLoaded", function () {
  EstablecerTabla();
  $("#InputFecha").on("change", function () {
    var selectedDate = new Date($(this).val());
    var day = selectedDate.getDay(); // 0 es Domingo, 1 es Lunes, etc.
    if (day == 6) {
      // Deshabilita los Domingos
      $(this).val("").blur();
      Mensaje(
        "warning",
        "El dia seleccionado esta fuera del periodo de trabajo del ttaler"
      );
    }
  });
  $("#InputHora").on("change", function () {
    var horaSeleccionada = this.value; // Obtiene la hora seleccionada en el input
    var horaMinima = "09:00"; // Establece la hora mínima permitida
    var horaMaxima = "20:00"; // Establece la hora máxima permitida

    if (horaSeleccionada < horaMinima || horaSeleccionada > horaMaxima) {
      this.value = horaMinima; // Establece la hora mínima permitida
      Mensaje(
        "warning",
        "La hora seleccionada esta fuera del horario de trabajo. Puedes consultar los horario de trabajo en la seccion de ayuda"
      );
    }
  });
});

const FormularioPrestamos = document.querySelector("#FormularioPrestamos");
//Carga de los datos de maquinas , herramientas y materias
$(document).ready(function () {
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
});

//----------------------------------------- FUNCIONES DEL LISTADO DE PRESTAMOS --------------------------------
//Ver informacion completa de una solcitud
function VerSolicitud(idSolicitud) {
  $("#TituloModal").text("Datos de la solicitud");
  $("#ButtonAgregarSolicitud").toggleClass("d-none", true);
  $("#ButtonEditarSolicitud").toggleClass("d-none", false);
  $("#ButtonCancel").toggleClass("btn-danger", false).text("Cerrar");
  $("#FormularioModal select,input,textarea").prop("disabled", true);

  axios
    .post(
      "../../controllers/PrestamosController.php?option=EditarSolucitud&idSolicitud=" +
        idSolicitud
    )
    .then(function (response) {
      const info = response.data;
      //Inputs y claves de los valores a asignar
      $("#SolictudFooterStatus").css("background-color", info.color);
      const elementos = {
        "#InputIdSolicitud": "idSolicitud",
        "#InputStatus": "status",
        "#InputFecha": "Fecha_estimada",
        "#InputHora": "Hora_estimada",
        "#SelectMateria": "Materia_id",
        "#InputTipoTrabajo": "TipoTrabajo",
        "#InputDescripcion": "Descripcion",
      };

      //Asignacion de los valores a los inputs
      for (const [selector, propiedad] of Object.entries(elementos)) {
        $(selector).val(info[propiedad]);
      }

      if ($("#InputStatus").val() == "Solicitud") {
        // El elemento tiene el atributo style con el valor especificado
        $("#ButtonActivarSolicitud").removeClass("d-none");
      } else {
        $("#ButtonActivarSolicitud").addClass("d-none");
      }
      //Si se encuentran regitstros de maquinas en la BD, se gerera la tabla con los registros
      if (info.Maquinas) {
        const listaIds = info.Maquinas.split(",");
        const ListaMaquinas = Maquinas.filter((Maquina) =>
          listaIds.includes(Maquina.idMaquina)
        );
        const filas = ListaMaquinas.map((maquina) => {
          const fila = $("<tr>");
          $("<td>").text(maquina.idMaquina).appendTo(fila);
          $("<td>").text(maquina.NombreMaquina).appendTo(fila);
          $("<td>").text(maquina.ModeloMaquina).appendTo(fila);
          return fila;
        });
        $("#ContenedorMaquinas, #ContenedorHerramientas").removeClass("d-none");
        $("#TablaMaquinas tbody").empty().append(filas);
        $("#BtnHabilitarMaquinas").addClass("d-none");
        $("#AlertaMaquinas").empty();
        $("#TablaMaquinas").removeClass("d-none");
      } else {
        //En caso de no haber registros, se coloca un mensaje
        $("#ContenedorMaquinas").addClass("d-none");
        $("#AlertaMaquinas")
          .empty()
          .append(
            "<p class='text-danger font-weight-bold'>No se registraron maquinas en la solicitud</p>"
          );
      }
      //Si se encuentran regitstros de herrameintas en la BD, se gerera la tabla con los registros
      if (info.Herramientas) {
        const listaIds = info.Herramientas.split(",");
        const ListaHerramientas = Herramientas.filter((Herramienta) =>
          listaIds.includes(Herramienta.idHerramienta)
        );
        const filas = ListaHerramientas.map((Herramienta) => {
          const fila = $("<tr>");
          $("<td>").text(Herramienta.idHerramienta).appendTo(fila);
          $("<td>").text(Herramienta.NombreHerramienta).appendTo(fila);
          $("<td>").text(Herramienta.CantidadHerramienta).appendTo(fila);
          return fila;
        });
        $("#TablaHerramientas tbody").empty().append(filas);
        $("#BtnHabilitarHerramientas").addClass("d-none");
        $("#AlertaHerramientas").empty();
        $("#TablaHerramientas").removeClass("d-none");
      } else {
        //En caso de no haber registros, se coloca un mensaje
        $("#ContenedorHerramientas").addClass("d-none");
        $("#AlertaHerramientas")
          .empty()
          .append(
            "<p class='text-danger font-weight-bold'>No se registraron herramientas en la solicitud</p>"
          );
      }
    })
    .catch(function (error) {
      console.log(error);
    });
}
//EDICION DE SOLICTUD Habilitado de los campos de edicion del formulario de solictudes
$("#ButtonEditarSolicitud").click(function () {
  const formElements = $(
    "#FormularioModal select, #FormularioModal input, #FormularioModal textarea"
  );
  $("#ContenedorMaquinas, #ContenedorHerramientas").removeClass("d-none");
  $("#ControlesAgregarMaquinas, #ControlesAgregarHerramientas")
    .removeClass("d-none")
    .addClass("d-flex");
  $("#ButtonEditarSolicitud, #ButtonAgregarSolicitud").toggleClass("d-none");
  $("#ButtonEditarSolicitud").text("Editar");
  $("#ButtonCancel").addClass("btn-danger").text("Cancelar");
  $("#AlertaMaquinas , #AlertaHerramientas").empty();

  formElements.not("#InputStatus").prop("disabled", false);
});
//----------------------------------------- FUNCIONES DE LAS MAQUINAS --------------------------------

var ListaMaquinasSeleccionadas = [];

$("#BtnAgregarMaquina").on("click", function () {
  alert("Agregar maquinas");
  var OpcionSeleccionada = $("#SelectMaquina option:selected");
  var idElemento = OpcionSeleccionada.val();
  var NombreElemneto = OpcionSeleccionada.text();
  var Tabla = "TablaMaquinas";
  if (OpcionSeleccionada.val() && OpcionSeleccionada.text() != "") {
    if ($.inArray(idElemento, ListaMaquinasSeleccionadas) === -1) {
      ListaMaquinasSeleccionadas.push(OpcionSeleccionada.val());
    }
  }
  console.log("Lista de maquinas: " + ListaMaquinasSeleccionadas);
  //GenerarTabla(Tabla, idElemento, NombreElemneto);
});
//----------------------------------------- FUNCIONES DE LAS HERRAMIENTAS --------------------------------
var ListaHerramientasSeleccionadas = [];
//Adicion de los valores des select "HerramientasSeleccionadas" a la tabla de maquinas.

$("#BtnAgregaHerramienta").on("click", function () {
  var OpcionSeleccionada = $("#SelectHerramienta option:selected");
  var idElemento = OpcionSeleccionada.val();
  var NombreElemneto = OpcionSeleccionada.text();

  let Tabla = "TablaHerramientas";
  if (OpcionSeleccionada.val() && OpcionSeleccionada.text() != "") {
    if ($.inArray(idElemento, ListaHerramientasSeleccionadas) === -1) {
      ListaHerramientasSeleccionadas.push(OpcionSeleccionada.val());
    }
  }
  console.log("Lista de herramientas: " + ListaHerramientasSeleccionadas);
  GenerarTabla(Tabla, idElemento, NombreElemneto);
});

function GenerarTabla(Tabla, idElemento, NombreElemneto) {
  var fila =
    "<tr><td>" +
    idElemento +
    "</td><td>" +
    NombreElemneto +
    "</td><td><button type='button' class='btn btn-danger btn-sm' id='EliminarElemento" +
    Tabla +
    "'><i class='fas fa-trash'></i></button></td></tr>";

  if (idElemento != "") {
    var found = false;
    $("#" + Tabla + " tr td:first-child").each(function () {
      //console.log($(this).text() + "-" + idElemento);
      if ($(this).text() === idElemento) {
        found = true;
        return false;
      }
    });
    if (found) {
      Mensaje("error", "Este objeto ya fue agregado a la tabla");
    } else {
      $("#" + Tabla).removeClass("d-none");
      var Tr = document.createElement("TR");
      Tr.innerHTML = fila;
      document.getElementById(Tabla).appendChild(Tr);
    }
  } else {
    Mensaje("error", "Debe de selecionar un elemento de la lista");
  }
}

$(document).on(
  "click",
  "#EliminarElementoTablaPrestamoMaquinas",
  function (event) {
    event.preventDefault();
    FilaElimar = $(this).closest("tr");
    MaquinaEliminar = FilaElimar[0].firstChild.innerHTML;
    //console.log(MaquinaEliminar);
    ListaMaquinasSeleccionadas = ListaMaquinasSeleccionadas.filter(
      (item) => item !== MaquinaEliminar
    );
    //console.log(ListaMaquinas);
    FilaElimar.remove();
    if (ListaMaquinasSeleccionadas.length < 1) {
      $("#TablaPrestamoMaquinas").addClass("d-none");
    }
  }
);

//Eliminar Registro en la tabla de herramientas
$(document).on(
  "click",
  "#EliminarElementoTablaPrestamoHerramientas",
  function (event) {
    event.preventDefault();
    FilaElimar = $(this).closest("tr");
    HerramientaEliminar = FilaElimar[0].firstChild.innerHTML;
    //console.log(HerramientaEliminar);
    ListaHerramientasSeleccionadas = ListaHerramientasSeleccionadas.filter(
      (item) => item !== HerramientaEliminar
    );
    //console.log(ListaHerramientasSeleccionadas);
    FilaElimar.remove();
    if (ListaHerramientasSeleccionadas.length < 1) {
      $("#TablaPrestamoHerramientas").addClass("d-none");
    }
  }
);
/*
  var checkbox = document.getElementById("ChkTerminos");
  checkbox.addEventListener("change", validaCheckbox, false);
  function validaCheckbox() {
    var checked = checkbox.checked;
    //setTimeout(function () {
      if (checked) {
        $("#BtnEnviarSolicitud").attr("disabled", false);
        $("#TextoCondiciones").addClass("d-none");
      }else{
        $("#BtnEnviarSolicitud").attr("disabled", true);
        $("#TextoCondiciones").removeClass("d-none");
      }
    //}, 500);
  }
  $("#BtnEnviarSolicitud").click(function () {
    if (!checkbox.checked) {
      Mensaje("error", "Debe de aceptar los terminos y condiciones!");
    } else {
      $("#ModalTerminosCondiciones").modal("hide");
      var DatosFormulario = $("#FormularioPrestamos").serializeArray();
      DatosFormulario.push(
        { name: "ListaHerramientas", value: ListaHerramientasSeleccionadas },
        { name: "ListaMaquinas", value: ListaMaquinasSeleccionadas }
      );
      var FormularioValido = false;
      $.each(DatosFormulario, function (index, obj) {
        if (!obj.value) {
          $(`#${obj.name}`).addClass("is-invalid");
          validateEntradasFormulario();
        }
        if ($("form").find(".is-invalid").length) {
          Mensaje("error", "Por favor,llene todos los campos del formulario!");
          FormularioValido = false;
        } else {
              FormularioValido = true;
          //Mensaje("success", "solictud enviada correctamente");
        }
      });
      if(FormularioValido == true) {
          $("#FormularioPrestamos").submit();
      }
    }
  });
  
  function validateEntradasFormulario() {
    var selectList = $("select", $("#FormularioPrestamos"));
  
    selectList.change(function () {
      if ($(this).val() !== "") {
        $(this).removeClass("is-invalid");
      }
    });
    $("#InputDescripcion").keyup(function () {
      if ($(this).val()) {
        $(this).removeClass("is-invalid");
      }
    });
  }
  */

/*
  FormularioPrestamos.onsubmit = function (e) {
      e.preventDefault();
      const frmData = new FormData(this);
      frmData.append("ListaMaquinas",ListaMaquinasSeleccionadas);
      frmData.append("ListaHerramientas",ListaHerramientasSeleccionadas);
      console.log(frmData);
        axios.post('/controllers/PrestamosController.php?option=Registrar', frmData)
          .then(function (response) {
            const info = response.data;
            message(info.tipo, info.mensaje);
          })
          .catch(function (error) {
            console.log(error);
          });
    }*/

//----------------------------------------- FUNCIONES DEL LISTADO DE PRESTAMOS --------------------------------

//LImpieza del modal de resgistros
$("#FormularioModal").on("hidden.bs.modal", function () {
  // Limpiar la información dentro del modal
  //$("#ContendorTablaSolicitud").empty();
  $("#TablaMaquinas").addClass("d-none");
  $("#TablaHerramientas").addClass("d-none");
  $("#ControlesAgregarMaquinas, #ControlesAgregarHerramientas")
    .removeClass("d-flex")
    .addClass("d-none");
});

$("#ButtonAgregarSolicitud").click(function () {
  if (validarFormulario()) {
    $("#FormularioPrestamos").submit();
  } else {
    Mensaje("error", "Por favor,llene todos los campos del formulario!");
  }
});

//Validacion del formulario de registro
function validarFormulario() {
  var form = $("#FormularioPrestamos");
  var camposValidos = true;
  $("input, select, textarea", form).each(function () {
    if (this.type === "hidden") {
      return true; // Ignorar inputs de tipo hidden
    }
    if (this.id == "SelectMaquina" || this.id == "SelectHerramienta") {
      return true;
    }
    if ($(this).val() === "") {
      $(this).addClass("is-invalid");
      camposValidos = false;
      RetirarAlertasInputs();
    } else {
      $(this).removeClass("is-invalid");
    }
  });
  return camposValidos;
}

function RetirarAlertasInputs() {
  var selectList = $("select", $("#FormularioPrestamos"));
  selectList.change(function () {
    if ($(this).val() !== "") {
      $(this).removeClass("is-invalid");
    }
  });
  $("form :input").on("input", function () {
    // cuando se ingresa texto en un campo del formulario
    if ($(this).hasClass("is-invalid")) {
      // si tiene la clase is-invalid
      $(this).removeClass("is-invalid"); // remover la clase is-invalid del campo actual
    }
  });
}

//Mensaje de eliminacion de usuarios con sweet alert
function CancelarSolicitud(idSolicitud) {
  Swal.fire({
    title: "",
    text: "¿Deseas cancelar la solicitud?",
    icon: "warning",
    showCancelButton: true,
    cancelButtonColor: "#d33",
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      axios
        .post(
          "/controllers/PrestamosController.php?option=CancelarSolicitud&idSolicitud=" +
            idSolicitud
        )
        .then(function (response) {
          const info = response.data;
          Mensaje(info.tipo, info.mensaje);
          if (info.tipo == "success") {
            tablaSolicitudes.ajax.reload();
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  });
}
FormularioPrestamos.onsubmit = function (e) {
  e.preventDefault();
  const frmData = new FormData(this);
  frmData.append("ListaMaquinas", ListaMaquinasSeleccionadas);
  //frmData.append("ListaHerramientas",ListaHerramientasSeleccionadas);
  axios
    .post("/controllers/PrestamosController.php?option=Registrar", frmData)
    .then(function (response) {
      var info = response.data;
      console.log(info.tipo);
      if (info.tipo == "success") {
        $("#FormularioModal").modal("hide");
        Mensaje(info.tipo, info.mensaje);
        tablaSolicitudes.ajax.reload();
      }
    })
    .catch(function (error) {
      console.log(error);
      Mensaje(info.tipo, info.mensaje);
    });
};
$("#ButtonActivarSolicitud").on("click", function () {
  var idSolicitud = $("#InputIdSolicitud").val();
  $("#FormularioModal").modal('hide');
  Swal.fire({
    title: 'Ingrese su contraseña',
    html: '<input type="password" id="password-input" class="">',
    showCancelButton: true,
    confirmButtonText: 'Validar',
    cancelButtonText: 'Cancelar',
    allowOutsideClick: false,
    focusConfirm: false,
    preConfirm: () => {
      const password = document.getElementById('password-input').value;
      axios
      .post(
        "/controllers/PrestamosController.php?option=ActivarSolicitud&idSolicitud=" +
        idSolicitud
      )
      .then(function (response) {
        const info = response.data;
        Mensaje(info.tipo, info.mensaje);
        if (info.tipo == "success") {
          $('#FormularioModal').modal('hide');
          tablaSolicitudes.ajax.reload();
        }
      })
      .catch(function (error) {
        console.log(error);
      });
    }
  });

});
// Obtener referencias a los elementos del DOM
const openModalBtn = document.getElementById('openModalBtn');
const closeModalBtn = document.getElementById('closeModalBtn');
const modal = document.getElementById('modal');
const videoElement = document.getElementById('video-element');

// Función para abrir el modal y mostrar la transmisión de la cámara
function abrirModal() {
  // Mostrar el modal
  modal.style.display = 'block';

  // Verificar si el navegador es compatible con la API de captura multimedia
  if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // Opciones de la cámara
    const constraints = {
      video: true,
      audio: false
    };

    // Abrir la cámara
    navigator.mediaDevices.getUserMedia(constraints)
      .then(function(stream) {
        // Asignar el stream de la cámara al elemento de video
        videoElement.srcObject = stream;
        videoElement.play();
      })
      .catch(function(error) {
        console.log('Error al acceder a la cámara:', error);
      });
  } else {
    console.log('El navegador no admite la API de captura multimedia');
  }
}

// Función para cerrar el modal
function cerrarModal() {
  // Detener la transmisión de la cámara
  const stream = videoElement.srcObject;
  const tracks = stream.getTracks();
  tracks.forEach(function(track) {
    track.stop();
  });

  // Ocultar el modal
  modal.style.display = 'none';
}

// Agregar evento de clic al botón para abrir el modal
openModalBtn.addEventListener('click', abrirModal);

// Agregar evento de clic al botón para cerrar el modal
closeModalBtn.addEventListener('click', cerrarModal);
