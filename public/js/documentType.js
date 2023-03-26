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
