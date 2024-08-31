$(function () {
  // Datatable con paginador, buscardor y botones de opciones
  $("#example1")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
    })
    .buttons()
    .container()
    .appendTo("#example1_wrapper .col-md-6:eq(0)");
  // Datatable solo con paginador
  $("#example2").DataTable({
    paging: true,
    lengthChange: false,
    searching: false,
    ordering: true,
    info: true,
    autoWidth: false,
    responsive: true,
  });
  // Datatable con paginador, buscardor y cantidad de filas
  $("#example3").DataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    responsive: true,
  });
  $("#example4")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["csv", "excel", "print", "colvis"],
    })
    .buttons()
    .container()
    .appendTo("#example4_wrapper .col-md-6:eq(0)");

  //Datatable checkboxes
  $("#exampleCheckboxes").DataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    responsive: true,
    select: {
      style: "multi",
    },
    order: [[1, "asc"]],

    createdRow: function (row, data, dataIndex) {
      var cohort = data[4];
      var currentYear = new Date().getFullYear();

      if (cohort == currentYear) {
        var studentId = data[0];
        $("td:eq(0)", row).html(
          '<input type="checkbox" name="select_student[]" value="' +
            studentId +
            '">'
        );
      } else {
        $("td:eq(0)", row).html("");
      }
    },
  });

  $("#send-btn").on("click", function () {
    var selected_ids = [];
    $('input[name="select_student[]"]:checked').each(function () {
      selected_ids.push($(this).val());
    });

    var studentIds = selected_ids.join(",");

    $("#student_ids").val(studentIds);

    console.log("Student IDs: " + $("#student_ids").val());

    $("#studentForm").submit();
  });
});
