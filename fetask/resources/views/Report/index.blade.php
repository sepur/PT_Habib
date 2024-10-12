@extends('layout.main')

@section('content')
    <link rel="stylesheet" href="{{ asset('/assets') }}/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/assets') }}/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/assets') }}/css/vertical-layout-light/style.css">
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Report User</h4>
                            <div class="form-group col-md-3 mt-5">
                                <form method="GET" action="/eksekusireport">
                                    @csrf
                                    <select class="js-example-basic-single w-100" name="jenis_report">
                                        <option value="Excel">Excel</option>
                                        <option value="PDF">PDF</option>
                                    </select>
                                    <div class="form-group d-flex col-md-3 mt-3">
                                        <button type="submit" class="add btn btn-primary todo-list-add-btn"
                                            id="add-task">Proses
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('/assets') }}/vendors/js/vendor.bundle.base.js"></script>
        <script src="{{ asset('/assets') }}/vendors/select2/select2.min.js"></script>
        <script src="{{ asset('/assets') }}/js/select2.js"></script>
    @endsection
