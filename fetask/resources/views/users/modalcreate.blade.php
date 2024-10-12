<form id="myform" role="form text-left" enctype="multipart/form-data" method="POST">
    @csrf
    <!-- Baris 1 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="example-text-input" class="form-label" name="name">First Name</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="text" id="example-text-input" name="name">
        </div>
    </div>

    <!-- Baris 3 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="example-email-input" class="form-label">Email</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="email" name="email" id="email">
        </div>
    </div>

    <!-- Baris 4 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="username" class="form-label">Username</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="text" name="username" id="username">
        </div>
    </div>

    <!-- Baris 5 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="password" class="form-label">password</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="password" name="password" id="password">
        </div>
    </div>

    <!-- Baris 6 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="password_confirmation" class="form-label">Password Confirmation</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation"
                onfocus="focused(this)" onfocusout="defocused(this)">
        </div>
    </div>

    <!-- Footer Modal -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="CloseModal()">Cancel</button>
        <button type="submit" class="btn btn-primary" onclick="storeuser()">Add User</button>
    </div>
</form>
