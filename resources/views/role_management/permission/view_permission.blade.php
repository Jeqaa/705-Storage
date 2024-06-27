@extends('layoutslte.template')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Permission</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body table-responsive">
                        {{-- button add --}}
                        <form>
                            <div class="row">
                                @if (Auth::user()->can('permission.store'))
                                    <div class="addItemBtn px-0">
                                        <a class="btn btn-dark d-flex flex-column justify-content-center mb-3"
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
                                        <option value="announcement">Announcement</option>
                                        <option value="dashboard">Dashboard</option>
                                        <option value="history">History</option>
                                        <option value="produk">Product</option>
                                        <option value="profile">Profile</option>
                                        <option value="todos">To Do List</option>
                                        <option value="user_management">User Management</option>
                                        <option value="role_management">Role Management</option>
                                        <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                                    </select>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                                </div>
                            </div>
                        </form>
                        <div class="mb-3">
                            <label for="categoryFilter" class="form-label">Filter by Group:</label>
                            <select id="categoryFilter" class="form-control">
                                <option value="">All</option>
                            </select>
                        </div>
                        <table id="permissionsTable" class="table table-hover text-nowrap">
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
                                        <td class="text-center">
                                            @if (Auth::user()->can('permission.edit'))
                                                <a href="{{ route('permission.edit', $permission->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                            @endif
                                            @if (Auth::user()->can('permission.delete'))
                                                <form action="{{ route('permission.delete', $permission->id) }}"
                                                    method="POST" class="d-inline">
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
                    </div>
                </div>

            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#permissionsTable').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
                "language": {
                    "search": "Search:",
                    "paginate": {
                        "next": "&raquo;",
                        "previous": "&laquo;"
                    }
                }
            });

            // Populate the select element with unique categories
            var select = $('#categoryFilter');
            table.column(2).data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>');
            });

            // Apply the filter
            select.on('change', function() {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                table.column(2).search(val ? '^' + val + '$' : '', true, false).draw();
            });
        });
    </script>
@endsection
