$(document).ready(function () {
  // Selección del campo de búsqueda
  var campoBusqueda = $("#InputNombreMateria");
  // Selección del contenedor de resultados
  var resultados = $("#lista-resultados");

  // Función para actualizar los resultados del autocompletado
  function actualizarResultados() {
    // Obtener el valor del campo de búsqueda
    var query = campoBusqueda.val();

    // Si el campo de búsqueda está vacío, ocultar los resultados
    if (query === "") {
      resultados.empty().hide();
    } else {
      // Realizar una petición AJAX utilizando Axios
      axios
        .get("/controllers/MateriasController.php?option=ListarProfesores", {
          params: { texto: query },
        })
        .then(function (response) {
          // Mostrar los resultados en el contenedor
          var html = "";
          $.each(response.data, function (index, item) {
            html +=
              '<div class="resultado" data-valor="' +
              item.NombreMateria +
              '">' +
              item.NombreMateria +
              "</div>";
          });
          resultados.html(html).show();
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  }

  // Actualizar los resultados cada vez que se escriba o borre una letra en el campo de búsqueda
  campoBusqueda.on("input", function () {
    actualizarResultados();
  });

  // Seleccionar un elemento de la lista de resultados
  $(document).on("click", ".resultado", function () {
    // Obtener el valor del elemento seleccionado
    var valor = $(this).data("valor");

    // Actualizar el campo de búsqueda con el valor seleccionado
    campoBusqueda.val(valor);

    // Ocultar los resultados
    resultados.empty().hide();
  });
});

// Verificar si existe la columna "Acciones" en el DOM
var accionesColumnExists =
  document.querySelector("#TablaMaterias th[data-name='Acciones']") !== null;
//console.log(accionesColumnExists);
var dataTableConfig = {
  ajax: {
    url: "../../controllers/MateriasController.php?option=listar",
    dataSrc: "",
  },
  columns: [
    { data: "ClaveMateria" },
    { data: "NombreMateria" },
    { data: "Profesor" },
    { data: "Grupo" },
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
$("#TablaMaterias").DataTable(dataTableConfig);

function AgregarMateria() {
  $("#TituloModal").text("Registrar nueva Materia");
  $("#FormularioRegistroMateria").find("select,input").removeAttr("disabled");
  $("#ButtonAgregarMateria").removeClass("d-none");
  $("#ButtonEditarMateria").addClass("d-none");
  $("#FormularioRegistroMateria").find("select,input").val("");
}
function VerMateria(idMateria) {
  $("#TituloModal").text("Ver informacion de la Materia");
  $("#ButtonAgregarMateria").addClass("d-none");
  $("#ButtonEditarMateria").addClass("d-none");
  $("#FormularioRegistroMateria").find("select,input").attr("disabled", "true");
  axios
    .post(
      "../../controllers/MateriasController.php?option=EditarMateria&idMateria=" +
        idMateria
    )
    .then(function (response) {
      const info = response.data;
      //console.log(info);
      $("#InputIdMateria").val(info.IdMateria);
      $("#InputClaveMateria").val(info.ClaveMateria);
      $("#InputNombreMateria").val(info.NombreMateria);
      $("#InputProfesor").val(info.Profesor);
      $("#InputGrupo").val(info.Grupo);
    })
    .catch(function (error) {
      console.log(error);
    });
}

function EditarMateria(idMateria) {
  $("#TituloModal").text("Editar informacion de Materia");
  $("#ButtonEditarMateria").removeClass("d-none");
  $("#ButtonAgregarMateria").addClass("d-none");
  $("#FormularioRegistroMateria").find("select,input").removeAttr("disabled");
  axios
    .post(
      "../../controllers/MateriasController.php?option=EditarMateria&idMateria=" +
        idMateria
    )
    .then(function (response) {
      const info = response.data;

      $("#InputIdMateria").val(info.IdMateria);
      $("#InputClaveMateria").val(info.ClaveMateria);
      $("#InputNombreMateria").val(info.NombreMateria);
      $("#InputProfesor").val(info.Profesor);
      $("#InputGrupo").val(info.Grupo);
    })
    .catch(function (error) {
      console.log(error);
    });
}
function EliminarMateria(idMateria) {
  MensajeEliminar(idMateria);
}

function MensajeEliminar(idMateria) {
  Swal.fire({
    title: "",
    text: "Deseas eliminar la Materia?",
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
          "/controllers/MateriasController.php?option=EliminarMateria&idMateria=" +
            idMateria
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
const FormularioRegistroMateria = document.querySelector(
  "#FormularioRegistroMateria"
);
FormularioRegistroMateria.onsubmit = function (e) {
  e.preventDefault();
  const FormularioDatos = new FormData(FormularioRegistroMateria);
  if (
    FormularioDatos.get("InputClaveMateria").trim() === "" ||
    FormularioDatos.get("InputNombreMateria").trim() === "" ||
    FormularioDatos.get("InputProfesor").trim() === " " ||
    FormularioDatos.get("InputGrupo").trim() === " "
  ) {
    Mensaje("error", "Asegurese de llenar todos los datos del formulario");
  } else {
    if (
      FormularioDatos.get("InputGrupo") == 1 ||
      FormularioDatos.get("InputGrupo") == 2 ||
      FormularioDatos.get("InputGrupo") == 3
    ) {
      axios
        .post("../../controllers/MateriasController.php?option=Registrar", {
          idMateria: FormularioDatos.get("InputIdMateria"),
          ClaveMateria: FormularioDatos.get("InputClaveMateria"),
          NombreMateria: FormularioDatos.get("InputNombreMateria"),
          Profesor: FormularioDatos.get("InputProfesor"),
          Grupo: FormularioDatos.get("InputGrupo"),
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
      Mensaje("error", "El grupo seleccionado No es valido");
    }
  }
};
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
