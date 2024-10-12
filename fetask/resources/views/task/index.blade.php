@extends('layout.main')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">List Task</h4>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-primary" onclick="create()">
                                    <i class="mdi mdi-plus-circle "></i> Add Task
                                </button>
                            </div>

                        </div>
                        <div class="card-body">
                            <div id="datatask" style="overflow: auto;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <!-- Modal -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="modal fade" id="Modalparam" tabindex="-1" role="dialog" aria-labelledby="ModalparamLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalparamLabel"></h5>
                    <p onclick="CloseModal()" id="close-button" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </p>
                </div>
                <div class="modal-body">
                    <div id="page" class="p-2"></div>
                </div>
            </div>
        </div>
    </div>
    @include('task.partials.script')
@endsection
