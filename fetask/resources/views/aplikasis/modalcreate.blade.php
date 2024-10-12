<form id="myform" role="form text-left" enctype="multipart/form-data" method="POST">
    @csrf
    <!-- Baris 1 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="example-text-input" class="form-label" name="nama">Nama</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="text" id="example-text-input" name="nama">
        </div>
    </div>

    <!-- Baris 2 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="example-email-input" class="form-label">Keterangan</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="text" name="keterangan" id="keterangan">
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
        </div>
    </div>

    <!-- Baris 4 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="link" class="form-label">Link</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="text" name="link" id="link">
        </div>
    </div>
    <!-- Footer Modal -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="CloseModal()">Cancel</button>
        <button type="submit" class="btn btn-primary" onclick="storeaplikasi()">Add Aplikasi</button>
    </div>
</form>
<script src="{{ asset('/assets') }}/js/file-upload.js"></script>
