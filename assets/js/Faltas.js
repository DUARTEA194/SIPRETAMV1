$(document).ready(function() {
    var url = "../../Controlador/ControladorUsuarios.php?opcion=listar";

    axios.get(url)
    .then(function(response) {

      var registros= response.data;

      var SelectUsuarios = $("#InputUsuarios");

      $.each(registros, function(i, registro) {
        SelectUsuarios.append('<option value="'+registro.idUsuario+'">'+registro.Nombre+'</option>');
      });
    })
    .catch(function(error) {
      console.log(error);
    });
  });

$("#InputUsuarios").change(function() {
var OpcionSeleccionada = $("#InputUsuarios option:selected");
var ValorSeleccionado = OpcionSeleccionada.val();
var TextoSeleccionado = OpcionSeleccionada.text();

$("#UsuarioSeleccionado").val(ValorSeleccionado+" - "+TextoSeleccionado);

});