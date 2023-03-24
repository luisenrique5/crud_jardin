jQuery(function () {
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
});
