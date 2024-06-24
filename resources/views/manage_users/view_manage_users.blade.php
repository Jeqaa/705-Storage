@extends('layoutslte.template')


@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Users</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                        </ol>
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
                                                <label>Category</label>
                                                <select class="select2" id="category" name="category" style="width: 100%;">
                                                    <option value="all">All</option>
                                                    <option value="best_seller">Best Seller</option>
                                                    <option value="other">Other</option>
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
                                        @if (isset($users) && count($users) > 0)
                                            <table class="table table-hover text-nowrap mb-0">
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
                                                            <td class="d-flex justify-content-center">
                                                                @if (Auth::user()->can('user.management.edit'))
                                                                    <a href="{{ route('manage-users.edit', $user->id) }}"
                                                                        class ="btn btn-primary me-2">Edit</a>
                                                                @endif
                                                                @if (Auth::user()->can('user.management.delete'))
                                                                    <form
                                                                        action="{{ route('manage-users.delete', $user->id) }}"
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
                                            <p class="text-danger font-weight-bold text-center pt-3">No users found.</p>
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
