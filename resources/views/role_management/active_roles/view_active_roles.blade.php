@extends('layoutslte.template')


@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Active Roles</h1>
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
                                        @if (isset($roles) && count($roles) > 0)
                                            <table class="table table-hover text-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Nama Role</th>
                                                        <th class="text-center">Permission</th>
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
                                                                    <span
                                                                        class="badge bg-danger">{{ $permission->name }}</span>
                                                                    @php $count++; @endphp
                                                                @endforeach
                                                            </td>
                                                            <td class="d-flex justify-content-center">
                                                                @if (Auth::user()->can('active.roles.edit'))
                                                                    <a href="{{ route('active.roles.edit', $role->id) }}"
                                                                        class ="btn btn-primary me-2">Edit</a>
                                                                @endif
                                                                @if (Auth::user()->can('active.roles.delete'))
                                                                    <form
                                                                        action="{{ route('active.roles.delete', $role->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger"
                                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus role ini?')">Delete</button>
                                                                    </form>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @php $i++; @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p class="text-danger font-weight-bold text-center pt-3">No active roles found.
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
