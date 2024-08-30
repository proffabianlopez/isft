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

  var table = $("#exampleCheckboxes").DataTable({
    paging: true,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    responsive: true,
    select: true,
    columnDefs: [
      {
        targets: 0,
        checkboxes: {
          selectRow: true
        },
      },
    ],
    select: {
      style: "multi",
    },
    order: [[1, "asc"]],
  });

  $('#send-btn').on('click', function(){
    var selected_rows = table.column(0).checkboxes.selected();

    var studentIds = selected_rows.join(",");

    $('#student_ids').val(studentIds);

    console.log("Student IDs: " + $('#student_ids').val());

    $('#studentForm').submit();
  });
});
