<html>
<head>
  <title>Ejemplo de consumo de servicio REST con jQuery</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <h1>Datos del personaje</h1>
  <div>
    <label for="idPersonaje">ID del personaje:</label>
    <input type="text" id="idPersonaje">
    <button id="btnBuscar">Buscar</button>
  </div>
  <div>
    <p>Nombre: <span id="nombre"></span></p>
    <p>Estatus: <span id="estatus"></span></p>
    <p>Especie: <span id="especie"></span></p>
  </div>
  <script>
    $(document).ready(function() {
      $('#btnBuscar').click(function() {
        const idPersonaje = $('#idPersonaje').val();
        const url = `https://rickandmortyapi.com/api/character/${idPersonaje}`;
        $.get({
          url: url,
          success: function(data) {
            $('#nombre').text(data.name);
            $('#estatus').text(data.status);
            $('#especie').text(data.species);
          },
          error: function() {
            alert('Error al obtener los datos');
          }
        });
      });
    });
  </script>
</body>
</html>