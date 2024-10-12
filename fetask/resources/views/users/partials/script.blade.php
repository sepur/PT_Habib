 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <script type="text/javascript">
     $(document).ready(function() {
         read();
     });

     function read() {
         var token = "{{ Session::get('token') }}";
         var headers = {
             'Authorization': 'Bearer ' + token,
             'Accept': 'application/json',
         };
         $.ajax({
             url: "{{ url('/listUser') }}",
             method: "GET",
             headers: headers,
             success: function(data) {
                 $("#datauser").html(data);
             },
             error: function(error) {
                 console.error('Failed to load user list:', error);
             }
         });
     }

     // Menampilkan modal
     function create() {
         $.get("{{ url('/createuser') }}", {}, function(data, status) {
             $("#ModalparamLabel").html('Add User');
             $("#page").html(data);
             $("#Modalparam").modal('show');
         });
     }
     // Store Data Ke Controller
     function storeuser() {
         event.preventDefault();
         var form = $('#myform')[0];
         var formData = new FormData(form);

         // Tambahkan CSRF token ke FormData
         var token = "{{ Session::get('token') }}";
         var headers = {
             'Authorization': 'Bearer ' + token,
             'Accept': 'application/json',
         };
         $.ajax({
             url: "{{ route('adduser') }}",
             data: formData,
             cache: false,
             processData: false,
             contentType: false,
             method: 'POST',
             success: function(data, textStatus, xhr) {
                 $("#page").html('');
                 read();
                 $("#page").html(data);
                 $("#Modalparam").modal("hide");
                 Swal.fire({
                     icon: 'success',
                     title: data.message,
                     showDenyButton: false,
                     showCancelButton: false,
                     confirmButtonText: 'Yes',
                     timer: 1500
                 });
             },
             error: function(xhr, status, error) {
                 var errorResponse = xhr.responseJSON;
                 var errorMessage = errorResponse.message;

                 Swal.fire({
                     icon: 'error',
                     title: 'Oops...',
                     text: errorMessage,
                 });
             }
         });
     }

     // Menampilkan modal Update
     function update(id) {
         $.get("{{ url('/showupdateuser') }}/" + id, {}, function(data, status) {
             $("#ModalparamLabel").html('Update User');
             $("#page").html(data);
             $("#Modalparam").modal('show');
         });
     }
     // Store Data Ke Controller
     function storeupdateuser(id) {
         event.preventDefault();
         var form = $('#myform')[0];
         var formData = new FormData(form);

         // Tambahkan CSRF token ke FormData
         var token = "{{ Session::get('token') }}";
         var headers = {
             'Authorization': 'Bearer ' + token,
             'Accept': 'application/json',
         };
         $.ajax({
             url: '/storeupdateuser/' + id,
             data: formData,
             cache: false,
             processData: false,
             contentType: false,
             method: 'POST',
             success: function(data, textStatus, xhr) {
                 $("#page").html('');
                 read();
                 $("#page").html(data);
                 $("#Modalparam").modal("hide");
                 Swal.fire({
                     icon: 'success',
                     title: data,
                     showDenyButton: false,
                     showCancelButton: false,
                     confirmButtonText: 'Yes',
                     timer: 1500
                 });
             },
             error: function(xhr, status, error) {
                 var errorResponse = xhr.responseJSON;
                 var errorMessage = errorResponse.message;
                 Swal.fire({
                     icon: 'error',
                     title: 'Oops...',
                     text: errorMessage,
                 });
             }
         });
     }

     function confirmDelete(id) {
         Swal.fire({
             title: 'Are you sure?',
             text: 'You want delete it!',
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes!'
         }).then((result) => {
             if (result.isConfirmed) {
                 executeDelete(id);
             }
         });
     }

     function executeDelete(id) {
         var csrf = "{{ csrf_token() }}";
         var token = "{{ Session::get('token') }}";
         var headers = {
             'X-CSRF-TOKEN': csrf,
             'Authorization': 'Bearer ' + token,
             'Accept': 'application/json',
         };
         $.ajax({
             url: '/deleteuser/' + id,
             headers: headers,
             method: 'POST',
             success: function(data, textStatus, xhr) {
                 read();
                 Swal.fire({
                     icon: 'success',
                     title: 'Deleted!',
                     text: 'Data has been deleted.',
                     showDenyButton: false,
                     showCancelButton: false,
                     confirmButtonText: 'Yes',
                     timer: 1500
                 });
             },
             error: function(xhr, status, error) {
                 var errorResponse = xhr.responseJSON;
                 var errorMessage = errorResponse.message;

                 Swal.fire({
                     icon: 'error',
                     title: 'Oops...',
                     text: errorMessage,
                 });
             }
         });
     }

     function CloseModal() {
         $("#Modalparam").modal("hide");
     }
 </script>
