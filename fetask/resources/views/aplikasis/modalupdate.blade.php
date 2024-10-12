<form id="myform" role="form text-left" enctype="multipart/form-data" method="PUT">
    @csrf
    <!-- Baris 1 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="example-text-input" class="form-label">Nama</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="text" id="example-text-input" name="nama"
                value="{{ $aplikasi->nama }}">
        </div>
    </div>

    <!-- Baris 2 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="example-email-input" class="form-label">Keterangan</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="text" name="keterangan" id="keterangan"
                value="{{ $aplikasi->keterangan }}">
        </div>
    </div>

    <!-- Baris 3 -->
    <div class="form-group row mb-3">
        <div class="col-md-3">
            <label for="gambar" class="form-label">Gambar</label>
        </div>
        <div class="col-md-9">
            <input type="file" name="gambar" class="file-upload-default">
            <div class="input-group ">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                </span>
            </div>
            <span class="input-group-append">
                <p class="text-success">Kosongkan Gambar Jika Tidak Akan Di Update</p>
            </span>
        </div>
    </div>

    <!-- Baris 4 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="link" class="form-label">Link</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="text" name="link" id="link" value="{{ $aplikasi->link }}">
        </div>
    </div>

    <!-- Footer Modal -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="CloseModal()">Cancel</button>
        <button type="submit" class="btn btn-primary" onclick="storeupdateapk({{ $aplikasi->id }})">Update
            Aplikasi</button>
    </div>
</form>
<script src="{{ asset('/assets') }}/js/file-upload.js"></script>
