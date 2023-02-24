
$(document).ready(function() {
  $("#edit-student-data-form").submit(function(e) {
    e.preventDefault();
    var formData = $("#edit-student-data-form").serialize();
    $.ajax({
      type: "POST",
      url: "{{ route('update.student') }}",
      data: formData,
      success: function(response) {
        console.log(response);
      },
      error: function(error) {
        console.log(error);
      }
    });
  });
});