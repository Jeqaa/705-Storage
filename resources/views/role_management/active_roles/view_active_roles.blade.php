@extends('layoutslte.template')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Active Roles</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="activeRolesTable" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Nama Role</th>
                                    <th class="text-center">Permissions</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($roles as $role)
                                    <tr>
                                        <td class="text-center">{{ $i }}</td>
                                        <td class="text-center">{{ $role->name }}</td>
                                        <td class="text-center">
                                            @php $count = 0; @endphp
                                            @foreach ($role->permissions as $permission)
                                                @if ($count % 10 == 0 && $count != 0)
                                                    <br>
                                                @endif
                                                <span class="badge bg-danger">{{ $permission->name }}</span>
                                                @php $count++; @endphp
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @if (Auth::user()->can('active.roles.edit'))
                                                <a href="{{ route('active.roles.edit', $role->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                            @endif
                                            @if (Auth::user()->can('active.roles.delete'))
                                                <form action="{{ route('active.roles.delete', $role->id) }}" method="POST"
                                                    class="d-inline">
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
            var table = $('#activeRolesTable').DataTable({
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
        });
    </script>
@endsection
