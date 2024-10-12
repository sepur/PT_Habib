@extends('layout.main')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">List User</h4>
                            <p class="card-description text-center text-sm-right">
                                <code>Home</code>/<a href="/"> List User</a>
                            </p>
                            <!-- Tombol untuk membuka modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                <i class="mdi mdi-plus-circle "></i> Add User
                            </button>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> No </th>
                                            <th> Name </th>
                                            <th> Email </th>
                                            <th> Profile </th>
                                            <th> Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $item)
                                            <tr class="text-center">
                                                <td>{{ $item->id }}-{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>user</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <div data-bs-toggle="modal" data-bs-target="#myEditModal"
                                                        class="icon
                                                    icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                        <i class="fa fa-pencil text-sm opacity-10" aria-hidden="true"></i>
                                                    </div>

                                                    <span>


                                                        <div onclick="confirmDelete({{ $item->id }})"
                                                            class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                            <i class="ni ni-money-coins text-lg opacity-10"
                                                                aria-hidden="true"></i>
                                                        </div>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- Modal -->

    <!-- Modal Add User -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Header Modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body">
                    <form role="form text-left" method="Post" action="/adduser">
                        @csrf
                        <!-- Baris 1 -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="example-text-input" class="form-label" name="name"> Name</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" id="example-text-input" onfocus="focused(this)"
                                    onfocusout="defocused(this)" name="name">
                            </div>
                        </div>

                        <!-- Baris 3 -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="example-email-input" class="form-label">Email</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="email" name="email" id="email"
                                    onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                        </div>

                        <!-- Baris 4 -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="username" class="form-label">Username</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="username" id="username"
                                    onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                        </div>

                        <!-- Baris 5 -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="password" class="form-label">password</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="password" name="password" id="password"
                                    onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                        </div>

                        <!-- Baris 6 -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="password" name="password_confirmation"
                                    id="password_confirmation" onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                        </div>

                        <!-- Footer Modal -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script>
            function confirmDelete(id) {
                console.log(`Button with ID ${id} clicked.`);

                // Handle the confirmed deletion, e.g., make the Ajax request
            }
        </script>
    @endsection
