$(function () {
  refreshTable();
  $(document).on("click", "#create-rols", function () {
    var id = $(this).data("id");
    $.get(
      `https://localhost:412/public/Roles/edit/${id}`,
      function (data) {
        $("#form-container").html(data.html);
        $("#exampleModal").modal("show");
      }
    );
  });

  $(document).on("click", ".edit-rols", function () {
    var id = $(this).data("id");
    $.get(
      `https://localhost:412/public/Roles/edit/${id}`,
      function (data) {
        $("#form-container").html(data.html);
        $("#exampleModal").modal("show");
      }
    );
  });

  $(document).on("click", "#save-rols", function () {
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
    $.get(`https://localhost:412/public/Roles/read`, function (data) {
      $("body").loading("stop");
      $("#table-rols").html(data.html);
    });
  }

  // Se define el evento click para los botones de eliminación de documentos
  $(document).on("click", ".delete-rols", function () {
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
                url: "/Roles/destroy/" + id,
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
                    $.get(`https://localhost:412/public/Roles/read`, function (data) {
                      $("body").loading("stop");
                      $("#table-rols").html(data.html);
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
});






