const FormularioRegistro = document.querySelector("#FormularioRegistroUsuario"); // Recuperacion del formulario
$("#BtnRegistroModal").on("click", function () {
  $("#FormularioRegistroUsuario").submit();
});
$("#InputTipoUsuario").on("change", function () {
  //lectura del tipo de usuario
  let TipoUsuario = this.value;
  //console.log(TipoUsuario);
  switch (TipoUsuario) {
    case "2":
      FormularioProfesor();
      break;
    case "3":
      FormularioAlumno();
      break;
    default:
      break;
  }
});
FormularioRegistro.onsubmit = function (e) {
  // Envio del formulario
  e.preventDefault();
  const FormularioDatos = new FormData(FormularioRegistro);
  //var TipoUsaurio = FormularioDatos.get("InputTipoUsuario");
  axios
    .post("/controllers/usuariosController.php?option=Registrar", {
      TipoUsuario: FormularioDatos.get("InputTipoUsuario"),
      Nombre: FormularioDatos.get("InputNombre"),
      ApellidoPa: FormularioDatos.get("InputApellidoPaterno"),
      ApellidoMa: FormularioDatos.get("InputApellidoMaterno"),
      NoCuenta: FormularioDatos.get("InputNoCuenta"),
      Semestre: FormularioDatos.get("InputSemestre"),
      Correo: FormularioDatos.get("InputCorreo"),
      Dependencia: FormularioDatos.get("InputDependencia"),
      Licenciatura: FormularioDatos.get("InputLicenciatura"),
      accion: "Registrar",
    })
    .then(function (response) {
      var info = response.data;
      if (info.tipo == "success") {
        var usuario = info.usuario;
        var password = info.pass;
        var correo = FormularioDatos.get("InputCorreo");
        EnviarCorreoregistro(usuario, password, correo);
      } else {
        Mensaje(info.tipo, info.mensaje);
      }
    })
    .catch(function (error) {
      console.erro(error);
    });
};

function ValidarCorreo(TipoUsaurio) {
  // Obtener los valores de los campos de texto y convertirlos a minúsculas
  var nombre = $("#InputNombre").val().toLowerCase();
  var apellidoPaterno = $("#InputApellidoPaterno").val().toLowerCase();
  var apellidoMaterno = $("#InputApellidoMaterno").val().toLowerCase();
  var Correo = $("#InputCorreo").val().toLowerCase();

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
  var dominio = TipoUsaurio == "2" ? "profesor.uaemex.mx" : "alumno.uaemex.mx";

  // Definir la expresión regular
  var PatronCorreo = new RegExp(
    "^(" +
      iniciales +
      "|" +
      inicialesv2 +
      ")[a-zA-Z0-9._%+-]+" +
      "@" +
      dominio +
      "$"
  );
  if (Correo.match(PatronCorreo)) {
    // La cadena de texto cumple con la expresión regular
    return true;
  } else {
    // La cadena de texto no cumple con la expresión regular
    $("#InputCorreo").addClass("is-invalid");
    return false;
  }
}
function FormularioAlumno() {
  //Configuracio del formulario para los alumnos
  $("#ContenedorSemestre, #ContenedorLicenciatura, #ContenedorDependencia").css(
    "display",
    "block"
  );
  $("#InputSemestre, #InputLicenciatura, #InputDependencia")
    .prop("required", true)
    .val("");

  $("#InputNoCuenta, #InputDependencia").parent().removeClass("col-md-12");
}
function FormularioProfesor() {
  //Configuracio del formulario para los profesores
  //Deshabilitar inputs
  $("#ContenedorSemestre, #ContenedorLicenciatura").css("display", "none");
  $("#InputSemestre, #InputLicenciatura").removeAttr("required").val("0");

  $("#ContenedorDependencia").css("display", "block");
  $("#InputDependencia").prop("required", true).val("0");

  $("#InputNoCuenta, #InputDependencia")
    .parent()
    .addClass("col-md-12")
    .val("0");
}
//Registro en dos pasos
$("#BtnRegistroUsuario").on("click", function () {
  const FormularioDatos = new FormData(FormularioRegistro);
  var TipoUsaurio = FormularioDatos.get("InputTipoUsuario");
  if (validarFormulario(TipoUsaurio)) {
    if (ValidarCorreo(TipoUsaurio)) {
      if (ValidarNoCuenta(FormularioDatos)) {
        //Funcion de envio...........................................................
        $("#ModalAviso").modal("show");
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

function validarFormulario(TipoUsaurio) {
  var form = $("#FormularioRegistroUsuario");
  var camposValidos = true;
  $("input, select", form).each(function () {
    if (
      this.type == "select-one" &&
      TipoUsaurio == "2" &&
      (this.id == "InputSemestre" || this.id == "InputLicenciatura")
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
//Mensaje en sweetalert para el usuario
function Mensaje(Tipo, Mensaje) {
  Swal.fire("", Mensaje, Tipo);
}
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
            "<p>Se ha enviado un correo electronico a su cuenta " +
            correo +
            ' con sus crendenciales de ingreso</p><br><a class="btn btn-sm btn-info" href="/">Ir al login</a>',
          allowOutsideClick: false,
          width: "50rem",
          showConfirmButton: false,
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
