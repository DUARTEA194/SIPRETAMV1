const permiso = document.querySelector("#frmPermiso");
const id_user = document.querySelector("#id_user");
const FormularioRegistroUsuario = document.querySelector(
  "#FormularioRegistroUsuario"
);
var tablaUsuarios;

function EstablecerTabla() {
  // Verificar si existe la columna "Acciones" en el DOM
  var accionesColumnExists =
    document.querySelector("#TablaUsuarios th[data-name='Acciones']") !== null;

  // Configurar DataTables
  var dataTableConfig = {
    ajax: {
      url: "controllers/usuariosController.php?option=listar&RolUsuarios=",
      dataSrc: "",
    },
    columns: [
      { data: "check" },
      { data: "status" },
      { data: "NoCuenta" },
      { data: "nombre" },
      { data: "RolUsuario" },
      { data: "correo" },
      { data: "Semestre" },
      { data: "Licenciatura" },
      { data: "Dependencia" },
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json",
    },
    order: [[0, "desc"]],
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

  // Agregar columna "Acciones" si existe
  if (accionesColumnExists) {
    dataTableConfig.columns.push({ data: "Acciones" });
  }

  // Inicializar DataTables
  tablaUsuarios = $("#TablaUsuarios").DataTable(dataTableConfig);
}

// Llamar a la función EstablecerTabla al cargar el DOM
document.addEventListener("DOMContentLoaded", EstablecerTabla);

function AgregarUsuario() {
  $("#TituloModal").text("Registrar nuevo usuario");
  $("#ButtonAgregarUsuario").text("Agregar").removeClass("d-none");
  $("#ButtonEditarUsuario").addClass("d-none");
  $("#FormularioModal :input").prop("disabled", false).val("");
  permisos();
}

function EliminarUsuario(idusuario) {
  MensajeEliminar(idusuario);
}
function VerUsuario(idusuario) {
  $("#TituloModal").text("Ver informacion de usuario");
  $("#ButtonAgregarUsuario").addClass("d-none");
  $("#ButtonEditarUsuario").removeClass("d-none");
  $("#ButtonCancel").removeClass("bg-danger").text("Cerrar");
  $("#FormularioModal").find("select,input").prop("disabled", true);
  axios
    .post(
      "../../controllers/usuariosController.php?option=EditarUsuario&idusuario=" +
        idusuario
    )
    .then(function (response) {
      const info = response.data;
      //console.log(info);
      switch (info.RolUsuario) {
        case "Administrador":
          FormularioAdministrador();
          break;
        case "Profesor":
          FormularioProfesor();
          break;
        case "Alumno":
          FormularioAlumno();
          break;
        default:
          break;
      }
      $("#InputIdUsuario").val(info.idusuario);
      $("#InputTipoUsuario").val(info.RolUsuario);
      $("#InputEstadoUsuario").val(info.status);
      $("#InputNombre").val(info.nombre);
      $("#InputApellidoPaterno").val(info.ApellidoPaterno);
      $("#InputApellidoMaterno").val(info.ApellidoMaterno);
      $("#InputNoCuenta").val(info.NoCuenta);
      $("#InputCorreoInstitucional").val(info.correo);
      $("#InputSemestre").val(info.Semestre);
      $("#InputLicenciatura").val(info.Licenciatura);
      $("#InputDependencia").val(info.Dependencia);
      permisos(idusuario);
    })
    .catch(function (error) {
      console.log(error);
    });
}
//Habilitado de los campos de edicion del formulario de usuarios
$("#ButtonEditarUsuario").click(function () {
  $("#ButtonEditarUsuario, #ButtonAgregarUsuario").toggleClass("d-none");
  $("#ButtonAgregarUsuario").text("Actualizar");
  $("#ButtonCancel").addClass("bg-danger").text("Cancelar");
  $("#FormularioModal select, #FormularioModal input").prop("disabled", false);
});

//Este evento verifica el cambio de usuario en el fomrualario
$("#InputTipoUsuario").on("change", function () {
  let TipoUsuario = this.value;
  //console.log(TipoUsuario);
  switch (TipoUsuario) {
    case "Administrador":
      FormularioAdministrador();
      break;
    case "Profesor":
      FormularioProfesor();
      break;
    case "Alumno":
      FormularioAlumno();
      break;
    default:
      break;
  }
});
//Edicion del formulario para usuariarios administradores
function FormularioAdministrador() {
  mostrarContenidoFormulario(false, false, false);
  PermisosAdministrador();
}
//Edicion del formulario para usuariarios profesores
function FormularioProfesor() {
  mostrarContenidoFormulario(false, false, true);
  PermisosProfesor();
}
//Edicion del formulario para usuariarios Alumnos
function FormularioAlumno() {
  mostrarContenidoFormulario(true, true, true);
  PermisosAlumno();
  //Ajustes del input de No de cuenta:

  $("#InputNoCuenta").removeClass("px-0").addClass("col-sm-12");
  $("#InputNoCuenta")
    .parent("div")
    .addClass("col-md-12")
    .removeClass("col-md-9");
  $("#ContenedorNoCuenta").addClass("col-md-6").removeClass("d-flex col-md-12");
  $("#ContenedorNoCuenta").find("label").addClass("col-sm-3 px-0");
}

function mostrarContenidoFormulario(
  mostrarSemestre,
  mostrarLicenciatura,
  mostrarDependencia
) {
  $("#ContenedorSemestre").toggle(mostrarSemestre);
  $("#InputSemestre").prop("required", mostrarSemestre).val("0");

  $("#ContenedorLicenciatura").toggle(mostrarLicenciatura);
  $("#InputLicenciatura").prop("required", mostrarLicenciatura).val("0");

  $("#ContenedorDependencia").toggle(mostrarDependencia);
  $("#InputDependencia").prop("required", mostrarDependencia).val("0");
  //Ajustes del input de No de cuenta:

  $("#InputNoCuenta").removeClass("px-0").addClass("col-sm-12");
  $("#InputNoCuenta")
    .parent("div")
    .removeClass("col-md-12")
    .addClass("col-md-9");
  $("#ContenedorNoCuenta").removeClass("col-md-6").addClass("d-flex col-md-12");
  $("#ContenedorNoCuenta").find("label").addClass("col-sm-3 px-0");
}
$("#ButtonAgregarUsuario").click(function () {
  const FormularioDatos = new FormData(FormularioRegistroUsuario);
  var TipoUsaurio = FormularioDatos.get("InputTipoUsuario");
  //console.log(FormularioDatos);
  if (validarFormulario(TipoUsaurio)) {
    if (ValidarCorreo(TipoUsaurio)) {
      if (ValidarNoCuenta(FormularioDatos)) {
        //var InputTelefono = FormularioDatos.get("InputNumeroTelefonico");
        //if (validarTelefono(InputTelefono)) {
        //Funcion de envio
        $("#FormularioRegistroUsuario").submit();
        //} else {
        // Mensaje("error", "El numero de telefono ingresado NO es valido");
        //}
      } else {
        Mensaje("error", "El numero de cuenta No es valido");
      }
    } else {
      Mensaje("error", "La cuenta de correo ingresada NO es valida");
    }
  } else {
    Mensaje("warning", "Porfavor llene los campos marcados en color rojo!");
  }
});

//Envio del formulario de Edicion/Registro de usuarios
FormularioRegistroUsuario.onsubmit = function (e) {
  e.preventDefault();
  var permisos = [];
  $('#frmPermiso input[type="checkbox"]:checked').each(function () {
    var valor = $(this).val();
    permisos.push(valor);
  });
  const FormularioDatos = new FormData(FormularioRegistroUsuario);
  FormularioDatos.append("Permisos", permisos);
  axios
    .post("../../controllers/usuariosController.php?option=Registrar", {
      IdUsuario: FormularioDatos.get("InputIdUsuario"),
      TipoUsuario: FormularioDatos.get("InputTipoUsuario"),
      EstadoUsuario: FormularioDatos.get("InputEstadoUsuario"),
      Nombre: FormularioDatos.get("InputNombre"),
      ApellidoPa: FormularioDatos.get("InputApellidoPaterno"),
      ApellidoMa: FormularioDatos.get("InputApellidoMaterno"),
      NoCuenta: FormularioDatos.get("InputNoCuenta"),
      Semestre: FormularioDatos.get("InputSemestre"),
      Correo: FormularioDatos.get("InputCorreoInstitucional"),
      Dependencia: FormularioDatos.get("InputDependencia"),
      Licenciatura: FormularioDatos.get("InputLicenciatura"),
      Permisos: FormularioDatos.get("Permisos"),
      accion: "Registrar",
    })
    .then(function (response) {
      
      $('#FormularioModal').modal('hide');
      var info = response.data;
      if (info.tipo == "success") {
        var usuario = info.usuario;
        var password = info.pass;
        var correo = FormularioDatos.get("InputCorreoInstitucional");
        EnviarCorreoregistro(usuario, password, correo);
      } else {
        Mensaje(info.tipo, info.mensaje);
      }
    })
    .catch(function (error) {
      console.log(error);
    });
};
//Mensaje de eliminacion de usuarios con sweet alert
function MensajeEliminar(idusuario) {
  Swal.fire({
    title: "",
    text: "Deseas eliminar al usuario?",
    icon: "warning",
    showCancelButton: true,
    cancelButtonColor: "#d33",
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Si, Eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      axios
        .post(
          "/controllers/usuariosController.php?option=EliminarUsuario&idusuario=" +
            idusuario
        )
        .then(function (response) {
          const info = response.data;
          Mensaje(info.tipo, info.mensaje);
          if (info.tipo == "success") {
            setTimeout(() => {
              window.location.reload();
            }, 1500);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  });
}

//********************************************************************************************************************************
//permiosos

function permisos(idusuario) {
  if (!idusuario) {
    axios
      .get("../../controllers/usuariosController.php?option=permisos")
      .then(function (response) {
        const ListaPermisos = response.data;
        let html = "";
        ListaPermisos.permisos.forEach((permiso) => {
          let accion = ListaPermisos.asig[permiso.id] ? "checked" : "";
          html += `<div>
            <label class="mb-2">
                <input type="checkbox" id="${permiso.nombre}" name="permisos[]" value="${permiso.id}" ${accion}> ${permiso.nombre}
             </label>
            </div>`;
        });
        permiso.innerHTML = html;
      });
  } else {
    axios
      .get(
        "../../controllers/usuariosController.php?option=permisos&idusuario=" +
          idusuario
      )
      .then(function (response) {
        const info = response.data;
        let html = "";
        info.permisos.forEach((permiso) => {
          let accion = info.asig[permiso.id] ? "checked" : "";
          html += `<div>
            <label class="mb-2">
                <input type="checkbox" name="permisos[]" value="${permiso.id}" disabled="true" ${accion}> ${permiso.nombre} 
            </label>
            </div>`;
        });
        html += `<input name="id_usuario" type="hidden" value="${idusuario}" />`;
        permiso.innerHTML = html;
        //$('#modalPermiso').modal('show');
      })
      .catch(function (error) {
        console.log(error);
      });
  }
}
function AsignarPermisos(Permisos) {
  $('#frmPermiso input[type="checkbox"]').each(function () {
    if ($.inArray(this.id, Permisos) !== -1) {
      $(this).prop("checked", true);
    }
  });
}
function PermisosAdministrador() {
  $('#frmPermiso input[type="checkbox"]').prop("checked", true);
}
function QuitarPermisos(Permisos) {
  $('#frmPermiso input[type="checkbox"]').prop("checked", false);
}

function PermisosProfesor() {
  QuitarPermisos();
  AsignarPermisos(["Maquinas", "Herramientas"]);
}

function PermisosAlumno() {
  QuitarPermisos();
  AsignarPermisos(["Maquinas", "Herramientas", "Perfil", "Compras"]);
}
//////////////////////////////////////////////////////////////////////////
function validarFormulario(TipoUsaurio) {
  var form = $("#FormularioRegistroUsuario");
  var camposValidos = true;
  $("input, select", form).each(function () {
    if (this.type === "hidden") {
      return true; // Ignorar inputs de tipo hidden
    }
    if (
      this.id == "InputCorreoPersonal" ||
      this.id == "InputNumeroTelefonico"
    ) {
      return true;
    }
    if (
      this.type == "select-one" &&
      TipoUsaurio == "Profesor" &&
      (this.id == "InputSemestre" || this.id == "InputLicenciatura")
    ) {
      return true; // Ignorar estos select
    }
    if (
      this.type == "select-one" &&
      TipoUsaurio == "Administrador" &&
      (this.id == "InputSemestre" ||
        this.id == "InputLicenciatura" ||
        this.id == "InputDependencia")
    ) {
      return true; // Ignorar estos select
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
  var selectList = $("select", $("#FormularioRegistroUsuario"));
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
function ValidarNoCuenta(FormularioDatos) {
  if (
    FormularioDatos.get("InputNoCuenta").length === 7 &&
    !isNaN(FormularioDatos.get("InputNoCuenta"))
  ) {
    return true;
  }
  $("#InputNoCuenta").addClass("is-invalid");
  return false;
}
function ValidarCorreo(TipoUsaurio) {
  // Obtener los valores de los campos de texto y convertirlos a minúsculas
  var nombre = $("#InputNombre").val().toLowerCase();
  var apellidoPaterno = $("#InputApellidoPaterno").val().toLowerCase();
  var apellidoMaterno = $("#InputApellidoMaterno").val().toLowerCase();
  var Correo = $("#InputCorreoInstitucional").val().toLowerCase();

  // Obtener la primera letra de cada nombre y apellido y concatenarlos
  var iniciales = "";
  var inicialesv2 = "";
  nombre.split(" ").forEach(function (palabra) {
    iniciales += palabra.charAt(0);
  });
  // Mostrar el resultado en la consola
  iniciales += apellidoPaterno + apellidoMaterno.charAt(0);
  inicialesv2 += nombre.charAt(0) + apellidoPaterno + apellidoMaterno.charAt(0);

  // Obtener el valor del tipo de usuario
  //var tipoUsuario = $("#InputTipoUsuario").val();

  // Definir el dominio de correo electrónico
  //var dominio =TipoUsaurio == "Profesor" ? "profesor.uaemex.mx" : "alumno.uaemex.mx";
  var dominio =
    TipoUsaurio == "Profesor"
      ? "profesor.uaemex.mx"
      : TipoUsaurio == "Alumno"
      ? "alumno.uaemex.mx"
      : "uaemex.mx";

  // Definir la expresión regular para alumnos y profesores
  var PatronCorreo = new RegExp(
    "^((" +
      iniciales +
      "|" +
      inicialesv2 +
      ")([a-zA-Z0-9._%+-]+)?)@" +
      dominio +
      "$"
  );
  //console.log(PatronCorreo);
  if (Correo.match(PatronCorreo)) {
    // La cadena de texto cumple con la expresión regular
    return true;
  } else {
    // La cadena de texto no cumple con la expresión regular
    $("#InputCorreo").addClass("is-invalid");
    return false;
  }
}
/*
function validarTelefono(InputTelefono) {
  const regexTelefono = /^\d{10}$/; // Expresión regular que valida números telefónicos de 10 dígitos

  // Validar si el valor es un número telefónico de 10 dígitos
  if (regexTelefono.test(InputTelefono)) {
    // Si es válido, quitar la clase "is-invalid" del input
    $("#InputNumeroTelefonico").removeClass("is-invalid");
    return true; // Indicar que el valor es válido
  } else {
    // Si es inválido, agregar la clase "is-invalid" al input
    $("#InputNumeroTelefonico").addClass("is-invalid");
    return false; // Indicar que el valor es inválido
  }
}
*/

////////////////////////////////////////////////////////////////////////////////////
//Sendgrig
$("#BtnEnviarCorreo").on("click", function () {
  var Nombre = "DUCA";
  axios
    .post("/assets/vendor/sendgrid-php/EnviarCorreo.php?Nombre=" + Nombre)
    .then(function (response) {
      console.log(response);
      //const info = response.data;
      //Mensaje(info.tipo, info.mensaje);
    })
    .catch(function (error) {
      console.log(error);
    });
});
function EnviarCorreoregistro(usuario, password, correo) {
  axios
    .post(
      "/assets/vendor/sendgrid-php/CorreoRegistro.php?Nombre=" +
        usuario +
        "&Password=" +
        password +
        "&Correo=" +
        correo
    )
    .then(function (response) {
      var info = response.data;
      if (info == "success") {
        Swal.fire({
          icon: "success",
          title: "Registro completado con exito",
          html:
            "<p>Se ha enviado un correo electronico a la cuenta " +
            correo +
            ' con sus crendenciales de ingreso</p><br>',
          allowOutsideClick: false,
          width: "50rem",
          showConfirmButton: true,
          confirmButtonText: "OK"        
        }).then((result) => {
          if (result.isConfirmed) {
            //window.location.reload(); // Recargar la página
            tablaUsuarios.ajax.reload();
          }
        });
      }
      else{
        Mensaje("error","Sucedio un error al enviar las crendeciales porfavor ponte en contacto con los administradores del sistema")
      }
    })
    .catch(function (error) {
      console.log(error);
    });
}

//------------------------------------------------------------------------------------------------
//Funiones de la carga masiva
//funciones de la cargamasiva
$("#load-csv-button").click(function () {
  var input = $("#csv-file-input")[0];
  // Validar que se haya seleccionado un archivo
  if (!input.files || !input.files[0]) {
    Mensaje("warning", "No se ha seleccionado ningún archivo");
    return;
  }

  // Validar la extensión del archivo
  var fileExtension = input.files[0].name.split(".").pop().toLowerCase();
  if (fileExtension !== "csv") {
    Mensaje("error", "El archivo seleccionado debe tener la extensión CSV");
    return;
  }
  // Ocultar el botón de carga masiva y mostrar el botón de limpiar
  $(this).addClass("d-none");
  $("#BtnLimpiarCargaMasiva").removeClass("d-none");

  var reader = new FileReader();
  reader.onload = function (e) {
    var csv = e.target.result;
    var data = $.csv.toArrays(csv);
    var $tbody = $("#csv-table tbody");
    $tbody.empty();
    for (var i = 1; i < data.length; i++) {
      var $tr = $("<tr>");
      for (var j = 0; j < data[i].length; j++) {
        $tr.append($("<td>").text(data[i][j]));
      }
      $tbody.append($tr);
    }
  };
  reader.readAsText(input.files[0]);
  eader.readAsText(input.files[0]);
});

// Asignar el evento de clic al botón
$("#BtnLimpiarCargaMasiva").click(function () {
  $(this).addClass("d-none");
  $("#load-csv-button").removeClass("d-none");
  // Limpiar el input
  $("#csv-file-input").val("");
  // Eliminar las filas de la tabla
  $("#csv-table tbody").empty();
});
