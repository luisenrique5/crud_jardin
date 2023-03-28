$(function () {
  refreshTable();
  $(document).on("click", "#create-document-type", function () {
    var id = -1;
    $.get(
      `https://localhost:412/public/DocumentsTypes/edit/${id}`,
      function (data) {
        $("#form-container").html(data.html);
        $("#exampleModal").modal("show");
      }
    );
  });

  $(document).on("click", ".edit-document-type", function () {
    var id = $(this).data("id");
    $.get(
      `https://localhost:412/public/DocumentsTypes/edit/${id}`,
      function (data) {
        $("#form-container").html(data.html);
        $("#exampleModal").modal("show");
      }
    );
  });

  $(document).on("click", "#save-document-type", function () {
    var form = $(this).closest("form");
    var url = form.attr("action");
    var datos = form.serializeArray();
    $.post(url, datos)
      .done(function (data) {
        $("#exampleModal").modal("hide");
        Swal.fire({
          title: data.title,
          html: data.html,
          icon: data.icon,
          showConfirmButton: false,
          timer: 2000,
        });
        refreshTable();
      })
      .fail(function (data) {
        if (data.status == 422) {
          let errores = `<ol>`;
          console.log(data.responseJSON.errors);

          // código que se ejecuta si la solicitud no se completa correctamente
          for (var field in data.responseJSON.errors) {
            var errors = data.responseJSON.errors[field];
            for (var i = 0; i < errors.length; i++) {
              var error = errors[i];
              errores += `<li>${error}</li>`;
            }
          }
          errores += `</ol>`;

          Swal.fire({
            title: `¡Algo salió Mal!`,
            html: `Errores en los campos:<br> ${errores}`,
            icon: `error`,
            showConfirmButton: true,
          });
        } else if (data.status == 500) {
          Swal.fire({
            title: `¡Algo salió Mal!`,
            html: `Ha ocurrido un error en el servidor, contacte al soporte de Pandora`,
            icon: `error`,
            showConfirmButton: false,
            timer: 3000,
          });
        }
      });
  });

  function refreshTable() {
    $("body").loading({
      message: "Cargando Datos",
    });
    $.get(`https://localhost:412/public/DocumentsTypes/read`, function (data) {
      $("body").loading("stop");
      $("#table-document-type").html(data.html);
    });
  }
});

function refreshTable() {
  // Aquí se construye la tabla HTML con los datos que se reciben en la variable 'data'
  var html = "";
  for (var i = 0; i < data.length; i++) {
    var documentType = data[i];
    html += `<tr>
      <td>${documentType.id}</td>
      <td>${documentType.name}</td>
      <td>
        <button class="btn btn-primary edit-document-type" data-id="${documentType.id}">Editar</button>
        <button class="btn btn-danger delete-document-type" data-id="${documentType.id}">Eliminar</button>
      </td>
    </tr>`;
  }

  // Se actualiza el contenido de la tabla HTML con el contenido generado anteriormente
  $("#table-document-type").html(html);
}

// Se define el evento click para los botones de eliminación de documentos
$(document).on("click", ".delete-document-type", function () {
  // Se obtiene el ID del documento que se va a eliminar
  var id = $(this).data("id");

  // Se muestra un diálogo de confirmación al usuario para verificar si desea eliminar el documento
  Swal.fire({
      title: "¿Está seguro que desea eliminar?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
  }).then((result) => {
      if (result.isConfirmed) {
          // Se obtiene el token CSRF
          var csrfToken = $('meta[name="csrf-token"]').attr('content');

          // Si el usuario confirma la eliminación, se envía una solicitud AJAX al servidor
          $.ajax({
              url: "/DocumentsTypes/destroy/" + id,
              type: "DELETE",
              data: {
                  _token: csrfToken,
              },
              success: function (data) {
                  // Si la eliminación es exitosa, se muestra una notificación y se actualiza la tabla
                  Swal.fire({
                      title: data.title,
                      html: data.html,
                      icon: data.icon,
                      showConfirmButton: false,
                      timer: 2000,
                  });
                   // Se actualiza la tabla de documentos después de eliminar el registro
                   $("body").loading({
                    message: "Cargando Datos",
                  });
                  $.get(`https://localhost:412/public/DocumentsTypes/read`, function (data) {
                    $("body").loading("stop");
                    $("#table-document-type").html(data.html);
                  });
              },
              error: function (data) {
                  // Si la eliminación falla, se muestra un mensaje de error al usuario
                  Swal.fire({
                      title: `¡Algo salió Mal!`,
                      html: `Ha ocurrido un error en el servidor, contacte al soporte de Pandora`,
                      icon: `error`,
                      showConfirmButton: false,
                      timer: 3000,
                  });
              },
          });
      }
  });
});



