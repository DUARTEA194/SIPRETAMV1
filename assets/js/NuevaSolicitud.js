//obtencion del formulario de registro
const FormularioPrestamos = document.querySelector("#FormularioPrestamos");
var Maquinas;
var Herramientas;
var Materias;

//carga de las materias, maquinas y herramientas en el DOM
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
  $("#InputFecha").on("change", function () {
    var selectedDate = new Date($(this).val());
    var day = selectedDate.getDay(); // 0 es Domingo, 1 es Lunes, etc.
    if (day == 6) {
      // Deshabilita los Domingos
      $(this).val("").blur();
      Mensaje("warning", "El dia seleccionado esta fuera del periodo de trabajo del taller");
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
// ++++++++++++++++++++ FUNCIONES DE MAQUINAS ++++++++++++++++++++++++++++
$("#BtnHabilitarMaquinas").on("click", function () {
  $(this).addClass("d-none");
  $("#SeccionMaquinas").addClass("d-flex");
});
var ListaMaquinasSeleccionadas = [];

$("#BtnAgregarMaquinas").on("click", function () {
  var OpcionSeleccionada = $("#SelectMaquina option:selected");
  var idElemento = OpcionSeleccionada.val();
  var NombreElemneto = OpcionSeleccionada.text();
  let Tabla = "TablaPrestamoMaquinas";

  if (OpcionSeleccionada.val() && OpcionSeleccionada.text() != "") {
    if ($.inArray(idElemento, ListaMaquinasSeleccionadas) === -1) {
      ListaMaquinasSeleccionadas.push(OpcionSeleccionada.val());
    }
  }
  //console.log("Lista de maquinas: " + ListaMaquinasSeleccionadas);
  GenerarTabla(Tabla, idElemento, NombreElemneto);
});
/*
// +++++++++++++++++++ FUNCIONES DE HERRAMIENTAS ++++++++++++++++++++++++++++++
$("#BtnHabilitarMaquinas").on("click", function () {
  $(this).addClass("d-none");
  $("#SeccionMaquinas").removeClass("d-none").addClass("d-flex");
});

var ListaHerramientasSeleccionadas = [];

$("#BtnAgregarHerramientas").on("click", function () {
  var OpcionSeleccionada = $("#SelectHerramienta option:selected");
  var idElemento = OpcionSeleccionada.val();
  var NombreElemneto = OpcionSeleccionada.text();
  let Tabla = "TablaPrestamoHerramientas";
  if (OpcionSeleccionada.val() && OpcionSeleccionada.text() != "") {
    if ($.inArray(idElemento, ListaHerramientasSeleccionadas) === -1) {
      ListaHerramientasSeleccionadas.push(OpcionSeleccionada.val());
    }
  }
  console.log("Lista de herramientas: " + ListaHerramientasSeleccionadas);
  GenerarTabla(Tabla, idElemento, NombreElemneto);
});
*/
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
/*
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
*/
var checkbox = document.getElementById("ChkTerminos");
checkbox.addEventListener("change", validaCheckbox, false);
function validaCheckbox() {
  var checked = checkbox.checked;
  //setTimeout(function () {
  if (checked) {
    $("#BtnEnviarSolicitud").attr("disabled", false);
  } else {
    $("#BtnEnviarSolicitud").attr("disabled", true);
    Mensaje(
      "warning",
      "Para enviar la solicitud debe de aceptar los terminos y condiciones"
    );
  }
  //}, 500);
}

$("#BtnEnviarSolicitud").click(function () {
  $("#ModalTerminosCondiciones").modal("hide");
  $("#FormularioPrestamos").submit();
});

$("#BtnValidarSolicitud").click(function () {
  if (validarFormulario()) {
    $("#ModalTerminosCondiciones").on("show.bs.modal", function (e) {
      var DatosFormulario = $("#FormularioPrestamos").serializeArray();
      /*const nuevaLista = Maquinas.filter((Maquina) =>
        ListaMaquinasSeleccionadas.includes(Maquina.idMaquina)
      );*/
      const nuevaLista = Maquinas.filter((Maquina) =>
        ListaMaquinasSeleccionadas.includes(Maquina.idMaquina)
      ).map((Maquina) => Maquina.NombreMaquina);

      console.log("Tabla de maquinas", nuevaLista);
      DatosFormulario.push({
        name: "ListaMaquinas",
        value: nuevaLista,
      });
      //console.log(DatosFormulario);
      var output = "";
      $.each(DatosFormulario, function () {
        output +=
          "<div class='row p-2 m-0'><label class='col-6'>" +
          this.name +
          ":" +
          "</label><input class='form-control form-control-sm col-6' value="+this.value+" disabled readonly></div>";
      });
      $("#InfoSolicitud").html(output);
    });
    $("#ModalTerminosCondiciones").modal("show");
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

FormularioPrestamos.onsubmit = function (e) {
  e.preventDefault();
  const frmData = new FormData(this);
  frmData.append("ListaMaquinas", ListaMaquinasSeleccionadas);
  idUsuario = $("#InputidUsuario").val();
  console.log(idUsuario);
  frmData.append("idUsuario", idUsuario);
  //frmData.append("ListaHerramientas",ListaHerramientasSeleccionadas);
  console.log(frmData);
  
  axios
    .post("/controllers/PrestamosController.php?option=Registrar", frmData)
    .then(function (response) {
      const info = response.data;
      Mensaje(info.tipo, info.mensaje);
      if (info.tipo == "success") {
        axios.post('/assets/vendor/sendgrid-php/CorreoSolicitud.php')
        .then(function (response) {
          //console.log(response);
          //setTimeout(() => {
          //  window.location.reload();
          //}, 2000);
        })
        .catch(function (error) {
          console.log(error);
        })
      }
    })
    .catch(function (error) {
      console.log(error);
      Mensaje(
        "error",
        "Algo salio mal, por favor intentelo nuevamente o contactese con losadministradores"
      );
    });
};
