const FormularioRegistroMaquina = document.querySelector(
  "#FormularioRegistroMaquina"
);
//Listado de las maquinas usando datatable
document.addEventListener("DOMContentLoaded", function () {
  var dataTableConfig = {
    ajax: {
      url: "/controllers/MaquinasController.php?option=listar",
      dataSrc: "",
    },
    columns: [
      { data: "idMaquina" },
      { data: "NombreMaquina" },
      { data: "ModeloMaquina" },
      { data: "EstadoMaquina" },
      { data: "Acciones" },
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
  // Inicializar DataTables
  var table = $("#TablaMaquinas").DataTable(dataTableConfig);
});

function AgregarMaquina() {
  // La imagen no tiene valor en el atributo "src"
  $("#InputImagen").attr("src", "/assets/img/load_image.png");
  $("#InputImagen").css({
    "max-width": "200px",
    opacity: 0.5,
  });

  $("#TituloModal").text("Registrar nueva maquina");
  $("#FormularioRegistroMaquina").find("select,input").removeAttr("disabled");
  $("#ButtonAgregarMaquina").removeClass("d-none").text("Agregar");
  $("#ButtonEditarMaquina").addClass("d-none");
  $("#FormularioRegistroMaquina").find("select,input,textarea").val("");
  GenerarInputImgen();
}
function VerMaquina(idMaquina) {
  $("#TituloModal").text("Ver informacion de la maquina");
  $("#ButtonAgregarMaquina").addClass("d-none");
  $("#ButtonEditarMaquina").removeClass("d-none");

  $("#ButtonCancel").removeClass("bg-danger").text("Cerrar");
  $("#FormularioModal").find("select,input").prop("disabled", true);

  $("#FormularioRegistroMaquina")
    .find("select,input,textarea")
    .attr("disabled", "true");
  $("#InputImagen").css({
    "max-width": "100%",
    opacity: 1,
  });
  axios
    .post(
      "../../controllers/MaquinasController.php?option=EditarMaquina&idMaquina=" +
        idMaquina
    )
    .then(function (response) {
      const info = response.data;
      //console.log(info);
      $("#InputIdMaquina").val(info.idMaquina);
      $("#InputNombreMaquina").val(info.NombreMaquina);
      $("#InputModeloMaquina").val(info.ModeloMaquina);
      $("#InputEstadoMaquina").val(info.EstadoMaquina);
      $("#InputDescripcionMaquina").val(info.DescripcionMaquina);
      $("#InputObservacionesMaquina").val(info.ObservacionesMaquina);
      if (info.ImagenMaquina != "") {
        $("#InputImagen").attr("src", info.ImagenMaquina);
      } else {
        $("#InputImagen")
          .attr("src", "/assets/img/load_image.png")
          .css({ "max-width": "200px" });
      }
    })
    .catch(function (error) {
      console.log(error);
    });
}
//Habilitado de los campos de edicion del formulario de maquinas
$("#ButtonEditarMaquina").click(function () {
  $("#ButtonEditarMaquina, #ButtonAgregarMaquina").toggleClass("d-none");
  $("#ButtonAgregarMaquina").text("Actualizar");
  $("#ButtonCancel").addClass("btn-danger").text("Cancelar");
  $("#FormularioRegistroMaquina")
    .find("select,input,textarea")
    .removeAttr("disabled");
  GenerarInputImgen();
  $("#imagen_url").val($("#InputImagen").attr("src"));
});
//Envio del formulario de Edicion/Registro de usuarios
$("#ButtonAgregarMaquina").click(function () {
  if (validarFormulario()) {
    //Mensaje("success", "datos llenos");
    $("#FormularioRegistroMaquina").submit();
  } else {
    Mensaje("warning", "Asegurese de llenar todos los datos del formulario");
  }
});

function EliminarMaquina(idMaquina) {
  MensajeEliminar(idMaquina);
}

function MensajeEliminar(idMaquina) {
  Swal.fire({
    title: "",
    text: "Deseas eliminar la maquina?",
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
          "/controllers/MaquinasController.php?option=EliminarMaquina&idMaquina=" +
            idMaquina
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
FormularioRegistroMaquina.onsubmit = function (e) {
  e.preventDefault();
  const FormularioDatos = new FormData(FormularioRegistroMaquina);
  FormularioDatos.append(
    "InputDescripcionMaquina",
    $("#InputDescripcionMaquina").val()
  );
  FormularioDatos.append(
    "InputObservacionesMaquina",
    $("#InputObservacionesMaquina").val()
  );

  axios
    .post("../../controllers/MaquinasController.php?option=Registrar", {
      idMaquina: FormularioDatos.get("InputIdMaquina"),
      NombreMaquina: FormularioDatos.get("InputNombreMaquina"),
      ModeloMaquina: FormularioDatos.get("InputModeloMaquina"),
      EstadoMaquina: FormularioDatos.get("InputEstadoMaquina"),
      DescripcionMaquina: FormularioDatos.get("InputDescripcionMaquina"),
      ObservacionesMaquina: FormularioDatos.get("InputObservacionesMaquina"),
      ImagenMaquina: FormularioDatos.get("imagen_url"),
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

function validarFormulario() {
  var form = $("#FormularioRegistroMaquina");
  var camposValidos = true;
  $("input, select", form).each(function () {
    if (this.type === "hidden") {
      return true; // Ignorar inputs de tipo hidden
    }
    if (
      this.id == "InputDescripcionMaquina" ||
      this.id == "InputObservacionesMaquina" ||
      this.id == "imagen_url"
    ) {
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
  var selectList = $("select", $("#FormularioRegistroMaquina"));
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

$("#ContenedorNuevaImagen").on("click", "#cargar_imagen", function () {
  var imageUrl = $("#imagen_url").val();
  if ($("#imagen_url").val() !== "") {
    $("#InputImagen").attr("src", imageUrl);
    $("#imagen_url").removeClass("is-invalid");
    $(this)
      .text("Limpiar")
      .removeAttr("id")
      .attr("id", "limpiar_imagen")
      .addClass("btn-danger");
  } else {
    $("#imagen_url").addClass("is-invalid");
  }
});

$("#ContenedorNuevaImagen").on("click", "#limpiar_imagen", function () {
  $("#InputImagen").attr("src", "/assets/img/load_image.png");
  $("#imagen_url").val("").removeClass("is-invalid");
  $(this).text("Agregar").removeAttr("id").attr("id", "cargar_imagen");
});

//Cuando el modal es enviado o cerrado se eliminan los elemntos creados anteriormente para cargar imagenes...
$("#ModalRegistroMaquina").on("hidden.bs.modal", function () {
  // Eliminar los elementos creados por JS
  $("#ContenedorNuevaImagen").empty();
});

function GenerarInputImgen() {
  // Crear los elementos HTML de la imagen
  $("#ContenedorNuevaImagen").append(
    $("<label>", {
      class: "col-sm-3 col-form-label col-form-label-sm",
      for: "imagen_url",
      text: "URL:",
    }),
    $("<input>", {
      type: "url",
      id: "imagen_url",
      class: "form-control form-control-sm text-gray-900 mx-1",
      name: "imagen_url",
      placeholder: "URL de la imagen",
    }),
    $("<button>", {
      type: "button",
      id: "cargar_imagen",
      class: "btn btn-success btn-sm",
      text: "Agregar",
    })
  );
}

$("#VerImagen").on("click", function () {
  var imageUrl = $("#InputImagen").attr("src");
  $("#ModalImagenSrc").attr("src", imageUrl);
  $("#ModalImagen").modal("show");
});
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
  reader.onload = function(e) {
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
  reader.readAsText(input.files[0]);eader.readAsText(input.files[0]);
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