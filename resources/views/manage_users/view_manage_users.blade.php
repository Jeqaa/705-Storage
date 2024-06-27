@extends('layoutslte.template')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Users</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="manageUsersTable" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Email Verified At</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Updated At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $i }}</td>
                                        <td class="text-center">{{ $user->name }}</td>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center">
                                            @foreach ($user->roles as $role)
                                                <span class="badge badge-pill bg-danger">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="text-center">{{ $user->email_verified_at }}</td>
                                        <td class="text-center">{{ $user->created_at }}</td>
                                        <td class="text-center">{{ $user->updated_at }}</td>
                                        <td class="text-center">
                                            @if (Auth::user()->can('user.management.edit'))
                                                <a href="{{ route('manage-users.edit', $user->id) }}"
                                                    class ="btn btn-primary me-2">Edit</a>
                                            @endif
                                            @if (Auth::user()->can('user.management.delete'))
                                                <form action="{{ route('manage-users.delete', $user->id) }}" method="POST">
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
            $('#manageUsersTable').DataTable({
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
