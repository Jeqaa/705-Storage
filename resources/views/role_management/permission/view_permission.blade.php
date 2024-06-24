@extends('layoutslte.template')


@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Permission</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->

                <section class="content">
                    <div class="container-fluid">
                        <form>
                            <div class="row">
                                <div class="col-md-10 px-0">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Sort</label>
                                                <select class="select2" id="sort" name="sort" style="width: 100%;">
                                                    <option value="asc">Ascending</option>
                                                    <option value="desc">Descending</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Kategori group</label>
                                                <select class="select2" id="category" name="category" style="width: 100%;">
                                                    <option selected>Pilih Group</option>
                                                    <option value="dashboard">Dashboard</option>
                                                    <option value="history">History</option>
                                                    <option value="overview">Overview</option>
                                                    <option value="profile">Profile</option>
                                                    <option value="role_management">Role Management</option>
                                                    <option value="todo">To Do List</option>
                                                    <option value="user_management">User Management</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- search bar --}}
                                    <div class="form-group">
                                        <div class="input-group input-group-lg">
                                            <input name="search" id="search" type="text" autocomplete="off"
                                                class="form-control form-control-lg" placeholder="Search...">
                                        </div>
                                    </div>
                                </div>
                                @if (Auth::user()->can('permission.store'))
                                    <div class="addItemBtn px-0">
                                        <a class="btn btn-danger d-flex flex-column justify-content-center mb-3"
                                            href="#" role="button" id="addItemBtn">
                                            <i class="bi bi-upload"></i>
                                            <div class="ms-2">Add permission</div>
                                        </a>
                                    </div>
                                    <div id="modalOverlay"></div>
                                @endif
                            </div>
                        </form>


                        <form id="myForm" class="col-md-6" action="{{ route('permission.store') }}" method="POST">
                            <div class="card-header d-flex justify-content-center border-bottom mb-3">
                                <h3 class="card-title py-3 fs-4 fw-bold">ADD PERMISSION</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="form-group">
                                    <label for="nama_permission" class="form-label">Nama Permission</label>
                                    <input type="text" class="form-control" id="nama_permission" name="nama_permission"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="nama_group" class="form-label">Group</label>
                                    <select class="form-select" id="nama_group" name="nama_group">
                                        <option value="dashboard">Dashboard</option>
                                        <option value="history">History</option>
                                        <option value="overview">Overview</option>
                                        <option value="profile">Profile</option>
                                        <option value="role_management">Role Management</option>
                                        <option value="todo">To Do List</option>
                                        <option value="user_management">User Management</option>
                                        <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                                    </select>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </section>


                <div class="row">
                    <div class="w-100">
                        <div class="card ">
                            <div class="card-body table-responsive p-0">
                                <div id="container-table" class="overflow-hidden">
                                    <div class="table-responsive">
                                        @if (isset($permissions) && count($permissions) > 0)
                                            <table class="table table-hover text-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Nama Permission</th>
                                                        <th class="text-center">Nama Group</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1; @endphp
                                                    @foreach ($permissions as $permission)
                                                        <tr>
                                                            <td class="text-center">{{ $i }}</td>
                                                            <td class="text-center">{{ $permission->name }}</td>
                                                            <td class="text-center">{{ $permission->group_name }}</td>
                                                            <td class="d-flex justify-content-center">
                                                                @if (Auth::user()->can('permission.edit'))
                                                                    <a href="{{ route('permission.edit', $permission->id) }}"
                                                                        class ="btn btn-primary me-2">Edit</a>
                                                                @endif
                                                                @if (Auth::user()->can('permission.delete'))
                                                                    <form
                                                                        action="{{ route('permission.delete', $permission->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger swa2-confirm-delete">Delete</button>
                                                                    </form>
                                                                @endif

                                                            </td>
                                                        </tr>
                                                        @php $i++; @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p class="text-danger font-weight-bold text-center pt-3">No permissions found.
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
@endsection
