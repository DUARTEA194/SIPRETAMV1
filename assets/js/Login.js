const FormularioLogin = document.querySelector("#FrmLogin");
var CorreoInstitucional = document.querySelector("#CorreoInstitucional");
var Password = document.querySelector("#Password");
document.addEventListener("DOMContentLoaded", function () {
  FormularioLogin.onsubmit = function (e) {
    e.preventDefault();
    if (CorreoInstitucional.value == "" || Password.value == "") {
      Mensaje("error", "Debe de ingresar los datos solicitados");
      validarFormulario();
    } else {
      axios
        .post("/controllers/usuariosController.php?option=acceso", {
          CorreoInstitucional: CorreoInstitucional.value,
          Password: Password.value,
          accion: "acceso",
        })
        .then(function (response) {
          const info = response.data;
          if (info.tipo == "success") {
            window.location = '../../plantilla.php';
          }
          Mensaje(info.tipo, info.mensaje);
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  };
});
//Muestra un mensaje al usuario
function Mensaje(Tipo, Mensaje) {
  Swal.fire("", Mensaje, Tipo);
}
function validarFormulario() {
  var form = $("#FrmLogin");
  var camposValidos = true;
  $("input", form).each(function () {
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
  $("form :input").on("input", function () {
    // cuando se ingresa texto en un campo del formulario
    if ($(this).hasClass("is-invalid")) {
      // si tiene la clase is-invalid
      $(this).removeClass("is-invalid"); // remover la clase is-invalid del campo actual
    }
  });
}