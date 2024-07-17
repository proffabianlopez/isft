$(document).ready(function() {
  function handleFormSubmit(formId, actionUrl, action) {
      $(document).on("submit", formId, function(e) {
          e.preventDefault();
          var formData = $(this).serialize();
          formData += "&action=" + encodeURIComponent(action);
          $.ajax({
              type: "POST",
              url: actionUrl,
              data: formData,
              dataType: "json",
              success: function(response) {
                  var messageContainer = $(".response-message");

                  if (response.status === "successLoad") {
                    $(".cierreModal").modal("hide"); // Cierra el modal
                    setTimeout(function () {
                      toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: "slideDown",
                        timeOut: 1500,
                        onHidden: function () {
                          location.reload();
                        },
                      };
                      toastr.success(
                        response.message,
                        response.title
                      );
                    });
                  } else if (response.status === "successReset") {
                    $(".cierreModal").modal("hide"); // Cierra el modal
                    setTimeout(function () {
                      toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: "slideDown",
                        timeOut: 1500,
                      };
                      toastr.success(
                        response.message,
                        response.title
                      );
                    });
                    resetForm();
                    messageContainer.html("");
                  }
                  else {
                      messageContainer.html(
                          '<div class="alert alert-danger mt-2">' + response.message + "</div>"
                      );
                  }
              },
              error: function(xhr, status, error) {
                  console.log(xhr.responseText);
                  $(".response-message").html(
                      '<div class="alert alert-danger">Error en la solicitud: ' +
                      error +
                      "</div>"
                  );
              },
          });
      });
      function resetForm() {
        $(".reset").val("");
      }
  }
  // Manejar el formulario de edición del profesor
  handleFormSubmit("#editteacher", "/ajax/teacherAjax.php", "editteacher");

  // Manejar el formulario de nuevo profesor
  handleFormSubmit("#newteacher", "/ajax/teacherAjax.php", "newteacher");
});
