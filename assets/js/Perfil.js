$(document).ready(function () {
  const valores = window.location.search;
  const ParametrosUrl = new URLSearchParams(valores);
  var idUsuario = ParametrosUrl.get("Usuario");

  axios
    .post(
      "/controllers/perfilcontroller.php?opcion=EditarUsuario&idUsuario=" +
        idUsuario
    )
    .then(function (response) {
      const info = response.data;
      $("#InputEstadoUsuario").val(info.status);
      $("#InputIdUsuario").val(info.idusuario);
      $("#InputTipoUsuario").text(info.RolUsuario);
      $("#InputNombre").val(info.nombre);
      $("#InputApellidoPaterno").val(info.ApellidoPaterno);
      $("#InputApellidoMaterno").val(info.ApellidoMaterno);
      $("#InputNoCuenta").val(info.NoCuenta);
      $("#InputCorreoInstitucional").val(info.correo);
      $("#InputSemestre").val(info.Semestre);
      $("#InputLicenciatura").val(info.Licenciatura);
      $("#InputDependencia").val(info.Dependencia);
      SetearUsuario();
    })
    .catch(function (error) {
      console.log(error);
    });
  return idUsuario;
});

function HabilitarInputs() {
  $("#BtnEdiatarPerfil").removeClass("d-sm-inline-block");
  $("#BtnCancelarPerfil").addClass("d-sm-inline-block");
  $("#BtnGuardarPerfil").addClass("d-sm-inline-block");

  $("#FormularioDatosUsuario")
    .find("input,select")
    .each(function () {
      $(this).prop("disabled", false).addClass("text-gray-900");
    });
}
function DeshabilitarInuts() {
  $("#BtnEdiatarPerfil").addClass("d-sm-inline-block");
  $("#BtnCancelarPerfil").removeClass("d-sm-inline-block");
  $("#BtnGuardarPerfil").removeClass("d-sm-inline-block");

  $("#FormularioDatosUsuario")
    .find("input,select")
    .each(function () {
      $(this).prop("disabled", true);
    });
}
function CancelarEdicion() {
  DeshabilitarInuts();
}
const FormularioDatosUsuario = document.querySelector(
  "#FormularioDatosUsuario"
);
$("#BtnGuardarPerfil").on("click", function () {
  const FormularioDatos = new FormData(FormularioDatosUsuario);
  var TipoUsaurio = $("#InputTipoUsuario").text()
  FormularioDatos.append("InputTipoUsuario",TipoUsaurio);
  console.log(TipoUsaurio);
  if (validarFormulario(TipoUsaurio)) {
    if (ValidarCorreo(TipoUsaurio)) {
      if (ValidarNoCuenta(FormularioDatos)) {
        //var InputTelefono = FormularioDatos.get("InputNumeroTelefonico");
        //if (validarTelefono(InputTelefono)) {
        //Funcion de envio
        $("#FormularioDatosUsuario").submit();
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

FormularioDatosUsuario.onsubmit = function (e) {
  e.preventDefault();
  const FormularioDatos= new FormData(FormularioDatosUsuario);
  var TipoUsaurio = $("#InputTipoUsuario").text()
  FormularioDatos.append("InputTipoUsuario",TipoUsaurio);
  axios
  .post("/controllers/usuariosController.php?option=EditarPerfil", {
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
};
/*
const FormularioDatosUsuario = document.querySelector(
    "#FormularioDatosUsuario"
  );*
FormularioDatosUsuario.onsubmit = function (e) {
    e.preventDefault();
    const FormularioDatos= new FormData(FormularioDatosUsuario);
    if (
        FormularioDatos.get("InputNombre").trim() === "" ||
        FormularioDatos.get("InputApellidoPaterno").trim() === " " ||
        FormularioDatos.get("InputApellidoMaterno").trim() === " " ||
        FormularioDatos.get("InputNoCuenta").trim() === "" ||
        FormularioDatos.get("InputCorreoInstitucional").trim() === ""
    ) {
      Mensaje("error", "Asegurese de llenar todos los datos del formulario");
    } else {
      const PatronCorreo = /^[a-z]+[0-9]{3}@alumno\.uaemex\.mx$/;
  
      if (
        FormularioDatos.get("InputNoCuenta").length === 7 &&
        !isNaN(FormularioDatos.get("InputNoCuenta"))
      ) {
        if (FormularioDatos.get("InputCorreoInstitucional").match(PatronCorreo)) {
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
        } else {
          Mensaje("error", "La cuenta de correo ingresada NO es valida");
        }
      } else {
        Mensaje("error", "El numero de cuenta ingresado NO es valido");
      }
    }

  };*/

//////////////////////////////////////////////////////////////////////////
function validarFormulario(TipoUsaurio) {
  var form = $("#FormularioDatosUsuario");
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
      (this.id == "InputSemestre" || this.id == "InputLicenciatura" || this.id == "InputDependencia")
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
    
    $("#InputCorreoInstitucional").addClass("is-invalid");
    return false;
  }
}

function SetearUsuario() {
  Nombre = $("#InputNombre").val();
  ApellidoPaterno = $("#InputApellidoPaterno").val();

  GenerarAvatar(Nombre, ApellidoPaterno);
}

function GenerarAvatar(Nombre, ApellidoPaterno) {
  var Iniciales = Nombre[0] + ApellidoPaterno[0];
  Iniciales = Iniciales.toUpperCase();
  var Avatar = $("<span>", {
    class: "avatar avatar-sm rounded-circle bg-success",
    text: Iniciales,
    css: {
      display: "flex",
      color: "white",
      fontSize: "50px",
      fontWeight: "bold",
      width: "140px",
      height: "140px",
      alignItems: "center",
      margin: "auto",
      justifyContent: "center",
    },
  });
  $("#ContenedorAvatarPerfil").append(Avatar);
}

function Mensaje(Tipo, Mensaje) {
  Swal.fire("", Mensaje, Tipo);
}
