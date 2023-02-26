//sos-table blade view
$(document).ready(function() {
  $('#sos-table').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
});

//incidents table
$(document).ready(function() {
  $('#incident-table').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
});

//all students table
$(document).ready(function() {
  $('#students-table').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
});

//all personnel table
$(document).ready(function() {
  $('#staffs-table').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
});

//personnel's active incidents blade view
$(document).ready(function() {
  $('#active-incident-table').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
});

//personnel's incidents history blade view
$(document).ready(function() {
  $('#personnel-incident-table').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
});

//students's incidents history blade view
$(document).ready(function() {
  $('#my-incidents-table').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
});

//admiting an sos details modal script
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

$(document).ready(function(){
  $(document).on('click', "#sos-id", function(){
    var id = $(this).attr('data-item-id');
    console.log(id);
    $("#sos_id").val(id);
  $('#admit-sos-modal').on('hide.bs.modal', function(){
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#admit-sos-form").trigger("reset");
  })
    // do something with the id here
  })

  
})

//updating an Incident details modal script
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

$(document).ready(function(){
  $(document).on('click', "#incident-id", function(){
    var id = $(this).attr('data-item-id');
    console.log(id);
    $("#incident_id").val(id);
  $('#update-incident-modal').on('hide.bs.modal', function(){
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#update-incident-form").trigger("reset");
  })
    // do something with the id here
  })

  
})

//updating student details modal script
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

$(document).ready(function(){
  $(document).on('click', "#reg-no", function(){
    var id = $(this).attr('data-item-id');
    var name = $(this).attr('data-item-name');
    var email = $(this).attr('data-item-email');
    var tel = $(this).attr('data-item-tel');
    console.log(id);
    $("#reg_no").val(id);
    $("#name").val(name);
    $("#email").val(email);
    $("#telephone").val(tel);
  $('#update-student-modal').on('hide.bs.modal', function(){
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#update-student-form").trigger("reset");
  })
    // do something with the id here
  })

  
})

//updating personnel details modal script
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

$(document).ready(function(){
  $(document).on('click', "#work-id", function(){
    var id = $(this).attr('data-item-id');
    var name = $(this).attr('data-item-name');
    var email = $(this).attr('data-item-email');
    var tel = $(this).attr('data-item-tel');
    console.log(id);
    $("#work_id").val(id);
    $("#name_p").val(name);
    $("#email_p").val(email);
    $("#telephone_p").val(tel);
  $('#update-personnel-modal').on('hide.bs.modal', function(){
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#update-personnel-form").trigger("reset");
  })
    // do something with the id here
  })

  
})

//rating an Incident modal script
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

$(document).ready(function(){
  $(document).on('click', "#rate-incident-id", function(){
    var id = $(this).attr('data-item-id');
    console.log(id);
    $("#incident_id").val(id);
  $('#rate-incident-modal').on('hide.bs.modal', function(){
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#rate-incident-form").trigger("reset");
  })
    // do something with the id here
  })

  
})

setTimeout(function() {
    $('#successMessage').fadeOut('fast');
}, 30000);


  // Get the notification container element
  var container = document.getElementById("sos-div");

  // Check if the container exists
  if (container) {
    // Remove the container on page refresh
    window.addEventListener("beforeunload", function () {
      container.remove();
    });
  }


setTimeout(function() {
    $('#sos-alert').fadeOut('fast');
}, 30000);