<form id="myform" role="form text-left" enctype="multipart/form-data" method="POST">
    @csrf
    <!-- Baris 1 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="example-text-input" class="form-label" name="name">First
                Name</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="text" id="example-text-input" onfocus="focused(this)"
                onfocusout="defocused(this)" name="name" value="{{ $usr->name }}">
        </div>
    </div>

    <!-- Baris 3 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="example-email-input" class="form-label">Email</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="email" name="email" id="email" onfocus="focused(this)"
                onfocusout="defocused(this)" value="{{ $usr->email }}">
        </div>
    </div>

    <!-- Baris 4 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="username" class="form-label">Username</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="text" name="username" id="username" onfocus="focused(this)"
                onfocusout="defocused(this)" value="{{ $usr->username }}">
        </div>
    </div>

    <!-- Footer Modal -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="CloseModal()">Cancel</button>
        <button type="submit" class="btn btn-primary" onclick="storeupdateuser({{ $usr->id }})">Update
            User</button>
    </div>
</form>
