$(function () {
  refreshTable();
  $(document).on("click", "#create-users", function () {
    var id = $(this).data("id");
    mostrarModalUsuario(id);
  });

  $(document).on("click", ".edit-users", function () {
    var id = $(this).data("id");
    mostrarModalUsuario(id);
  });

  function mostrarModalUsuario(id){
    
    $.get(
      `https://localhost:412/public/users/edit/${id}`,
      function (data) {
        $("#form-container").html(data.html);
        $("#exampleModal").modal("show");
        $('.selectpicker').selectpicker('refresh');
        validarForm("#formulario");
      }
    );
  }

  function validarForm(id,ignorar = ":hidden"){
      $(id).validate().destroy();	
        $(id).validate({ 
          debug: true,
          ignore: ignorar, 
          rules: {
            nickname: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        messages: {
            nickname: {
                required: "El campo es requerido."
            },
            email: {
                required: "El campo es requerido.",
                email: "El campo debe ser un correo."
            },
            password: {
                required: "El campo es requerido."
            }
        },
        errorPlacement : function(error, element) {
          $(element).siblings('.invalid-feedback ').html(error.html());          
        },
        highlight : function(element) {
          //$(element).closest('.invalid-feedback').removeClass('has-info').addClass('has-error');
          $(element).siblings('.invalid-feedback ').removeClass('has-info').addClass('has-error');
          $(element).removeClass('has-info').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).siblings('.invalid-feedback ').removeClass('has-error').addClass('has-info');
          $(element).removeClass('has-error').addClass('has-info');

          $(element).siblings('.invalid-feedback ').find('.input-clase').html('');
        }    
      });
  }

  
  $(document).on("click", "#save-users", function () {
    if ($("#formulario").valid()) {
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
    }else{
      Swal.fire({
        title: `¡Algo salió Mal!`,
        html: `valida los campos, porfavor!!!!`,
        icon: `error`,
        showConfirmButton: false,
        timer: 3000,
      });
    }
   
  });

  function refreshTable() {
    $("body").loading({
      message: "Cargando Datos",
    });
    $.get(`https://localhost:412/public/users/read`, function (data) {
      $("body").loading("stop");
      $("#table-users").html(data.html);
    });
  }

  // Se define el evento click para los botones de eliminación de documentos
  $(document).on("click", ".delete-users", function () {
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
                url: "/users/destroy/" + id,
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
                    $.get(`https://localhost:412/public/users/read`, function (data) {
                      $("body").loading("stop");
                      $("#table-users").html(data.html);
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






