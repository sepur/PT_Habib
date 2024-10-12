<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    $(document).ready(function() {
        read(); // Memanggil fungsi read saat halaman siap
    });

    function read() {
        var token = "{{ Session::get('token') }}"; // Mengambil token dari session
        var headers = {
            'Authorization': 'Bearer ' + token,
            'Accept': 'application/json',
        };
        $.ajax({
            url: "{{ url('/listtask') }}",
            method: "GET",
            headers: headers,
            success: function(data) {
                $("#datatask").html(data); // Mengisi data ke dalam elemen dengan id 'datatask'
            },
            error: function(error) {
                console.error('Failed to load Task list:', error);
            }
        });
    }

    // Menampilkan modal untuk menambah tugas
    function create() {
        $.get("{{ url('/createtask') }}", {}, function(data, status) {
            $("#ModalparamLabel").html('Add Task');
            $("#page").html(data);
            $("#Modalparam").modal('show');
        });
    }

    // Simpan data ke controller
    function storetask() {
        event.preventDefault();
        var form = $('#myform')[0];
        var formData = new FormData(form);
        var token = "{{ Session::get('token') }}";
        var headers = {
            'X-CSRF-TOKEN': token,
            'Authorization': 'Bearer ' + token,
            'Accept': 'application/json',
        };
        $.ajax({
            url: '/addtask/',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            method: 'POST',
            success: function(data) {
                $("#page").html('');
                read(); // Memanggil fungsi read untuk memperbarui tampilan tabel
                $("#Modalparam").modal("hide");
                Swal.fire({
                    icon: 'success',
                    title: 'Add!',
                    text: 'Data Has Save Successfully.',
                    confirmButtonText: 'Yes',
                    timer: 1500
                });
            },
            error: function(xhr) {
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

    // Menampilkan modal untuk memperbarui tugas
    function update(id) {
        $.get("{{ url('/showupdatetask') }}/" + id, {}, function(data, status) {
            $("#ModalparamLabel").html('Update Task');
            $("#page").html(data);
            $("#Modalparam").modal('show');
        });
    }

    // Simpan data yang diperbarui ke controller
    function storeupdatetask(id) {
        event.preventDefault();
        var form = $('#myform')[0];
        var formData = new FormData(form);
        var token = "{{ Session::get('token') }}";
        var headers = {
            'X-CSRF-TOKEN': token,
            'Authorization': 'Bearer ' + token,
            'Accept': 'application/json',
        };
        $.ajax({
            url: '/storeupdatetask/' + id,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            method: 'POST',
            success: function(data) {
                $("#page").html('');
                read();
                $("#Modalparam").modal("hide");
                Swal.fire({
                    icon: 'success',
                    title: 'Update!',
                    text: 'Update Has Successfully.',
                    confirmButtonText: 'Yes',
                    timer: 1500
                });
            },
            error: function(xhr) {
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

    // Konfirmasi penghapusan data
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to delete it!',
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

    // Eksekusi penghapusan data
    function executeDelete(id) {
        var csrf = "{{ csrf_token() }}";
        var token = "{{ Session::get('token') }}";
        var headers = {
            'X-CSRF-TOKEN': csrf,
            'Authorization': 'Bearer ' + token,
            'Accept': 'application/json',
        };
        $.ajax({
            url: '/deletetask/' + id,
            headers: headers,
            method: 'POST',
            success: function(data) {
                read();
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Data has been deleted.',
                    confirmButtonText: 'Yes',
                    timer: 1500
                });
            },
            error: function(xhr) {
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

