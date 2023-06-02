const FormularioRegistroHerramienta = document.querySelector(
  "#FormularioRegistroHerramienta"
);
//Listado de las herramientas usando datatable
document.addEventListener("DOMContentLoaded", function () {
  // Configurar DataTables
  var dataTableConfig = {
    ajax: {
      url: "controllers/HerramientasController.php?option=listar",
      dataSrc: "",
    },
    columns: [
      { data: "NombreHerramienta" },
      { data: "CantidadHerramienta" },
      { data: "EstadoHerramienta" },
      { data: "Acciones" },
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-MX.json",
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
  var table = $("#TablaHerramientas").DataTable(dataTableConfig);
});
function AgregarHerramienta() {
  $("#TituloModal").text("Registrar nueva herramienta");
  $("#FormularioRegistroHerramienta")
    .find("select,input,textarea")
    .removeAttr("disabled");
  $("#ButtonAgregarHerramienta").removeClass("d-none").text("Agregar");
  $("#ButtonEditarHerramienta").addClass("d-none");
  $("#FormularioRegistroHerramienta").find("select,input,textarea").val("");
}
function VerHerramienta(idHerramienta) {
  $("#TituloModal").text("Ver informacion de herramienta");
  $("#ButtonAgregarHerramienta").addClass("d-none");
  $("#ButtonEditarHerramienta").removeClass("d-none");

  $("#ButtonCancel").removeClass("bg-danger").text("Cerrar");
  $("#FormularioModal").find("select,input").prop("disabled", true);

  $("#FormularioRegistroHerramienta")
    .find("select,input, textarea")
    .attr("disabled", "true");
  axios
    .post(
      "../../controllers/HerramientasController.php?option=EditarHerramienta&idHerramienta=" +
        idHerramienta
    )
    .then(function (response) {
      const info = response.data;
      //console.log(info);
      $("#InputIdHerramienta").val(info.idHerramienta);
      $("#InputNombreHerramienta").val(info.NombreHerramienta);
      $("#InputCantidadHerramienta").val(info.CantidadHerramienta);
      $("#InputEstadoHerramienta").val(info.EstadoHerramienta);
    })
    .catch(function (error) {
      console.log(error);
    });
}
//Habilitado de los campos de edicion del formulario de maquinas
$("#ButtonEditarHerramienta").click(function () {
  $("#ButtonEditarHerramienta, #ButtonAgregarHerramienta").toggleClass(
    "d-none"
  );
  $("#ButtonAgregarHerramienta").text("Actualizar");
  $("#ButtonCancel").addClass("btn-danger").text("Cancelar");
  $("#FormularioRegistroHerramienta")
    .find("select,input,textarea")
    .removeAttr("disabled", "true");

  axios
    .post(
      "../../controllers/HerramientasController.php?option=EditarHerramienta&idHerramienta=" +
        idHerramienta
    )
    .then(function (response) {
      const info = response.data;

      $("#InputIdHerramienta").val(info.idHerramienta);
      $("#InputNombreHerramienta").val(info.NombreHerramienta);
      $("#InputCantidadHerramienta").val(info.CantidadHerramienta);
      $("#InputEstadoHerramienta").val(info.EstadoHerramienta);
    })
    .catch(function (error) {
      console.log(error);
    });
});
//Envio del formulario de Edicion/Registro de usuarios
$("#ButtonAgregarHerramienta").click(function () {
  if (validarFormulario()) {
    //Mensaje("success", "datos llenos");
    $("#FormularioRegistroHerramienta").submit();
  } else {
    Mensaje("warning", "Asegurese de llenar todos los datos del formulario");
  }
});
function EliminarHerramienta(idHerramienta) {
  MensajeEliminar(idHerramienta);
}

function MensajeEliminar(idHerramienta) {
  Swal.fire({
    title: "",
    text: "Deseas eliminar la herramienta?",
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
          "/controllers/HerramientasController.php?option=EliminarHerramienta&idHerramienta=" +
            idHerramienta
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

FormularioRegistroHerramienta.onsubmit = function (e) {
  e.preventDefault();
  const FormularioDatos = new FormData(FormularioRegistroHerramienta);
  FormularioDatos.append(
    "InputDescripcionHerramienta",
    $("#InputDescripcionHerramienta").val()
  );
  FormularioDatos.append(
    "InputObservacionesHerramienta",
    $("#InputObservacionesHerramienta").val()
  );

  axios
    .post("../../controllers/HerramientasController.php?option=Registrar", {
      idHerramienta: FormularioDatos.get("InputIdHerramienta"),
      NombreHerramienta: FormularioDatos.get("InputNombreHerramienta"),
      CantidadHerramienta: FormularioDatos.get("InputCantidadHerramienta"),
      EstadoHerramienta: FormularioDatos.get("InputEstadoHerramienta"),
      DescripcionHerramienta: FormularioDatos.get(
        "InputDescripcionHerramienta"
      ),
      ObservacionesHerramienta: FormularioDatos.get(
        "InputObservacionesHerramienta"
      ),
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
  var form = $("#FormularioRegistroHerramienta");
  var camposValidos = true;
  $("input, select", form).each(function () {
    if (this.type === "hidden") {
      return true; // Ignorar inputs de tipo hidden
    }
    if (
      this.id == "InputDescripcionHerramienta" ||
      this.id == "InputObservacionesHerramienta"
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
  var selectList = $("select", $("#FormularioRegistroHerramienta"));
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
