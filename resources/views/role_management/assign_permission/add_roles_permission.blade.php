@extends('layoutslte.template')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
    .form-check-label {
        text-transform: capitalize
    }
</style>

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Assign permission</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="w-100">
                        <div class="card ">
                            <div id="container-table" class="overflow-hidden">
                                @if (isset($roles) && count($roles) > 0)
                                    <div class="card-body">
                                        <form action="{{ route('assign.store') }}" method="POST">
                                            @csrf
                                            {{-- List of Group --}}
                                            <div class="form-group">
                                                <label for="naam_role" class="form-label">Nama Role</label>
                                                <select class="form-select" id="role_id" name="role_id">
                                                    <option selected disabled>Pilih Role</option>
                                                    @foreach ($roles as $role)
                                                        <option value={{ $role->id }}>{{ $role->name }}</option>
                                                    @endforeach
                                                    <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                                                </select>
                                            </div>

                                            {{-- Select all permission --}}
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkDefaultmain">
                                                <label class="form-check-label" for="checkDefaultmain">Pilih semua
                                                    permission</label>
                                            </div>

                                            <hr>

                                            @foreach ($permission_groups as $group)
                                                {{-- Group --}}
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input group-checkbox"
                                                                data-group="{{ $group->group_name }}" type="checkbox">
                                                            <label class="form-check-label">{{ $group->group_name }}</label>
                                                        </div>
                                                    </div>

                                                    {{-- Permission in a group --}}
                                                    <div class="col-9">
                                                        @php
                                                            $permissions = App\Models\User::getPermissionByGroupName(
                                                                $group->group_name,
                                                            );
                                                        @endphp
                                                        @foreach ($permissions as $permission)
                                                            <div class="form-check">

                                                                <input
                                                                    class="form-check-input permission-checkbox permission-checkbox-{{ $group->group_name }}"
                                                                    name="permission[]"
                                                                    id="checkDefault{{ $permission->id }}"
                                                                    value="{{ $permission->id }}" type="checkbox">

                                                                <label class="form-check-label"
                                                                    for="checkDefault{{ $permission->id }}">{{ $permission->name }}</label>

                                                            </div>
                                                        @endforeach
                                                        <br>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="form-group d-flex justify-content-between">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    @else
                                        <p class="text-danger font-weight-bold text-center pt-3">No roles found.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

    <script>
        $('#checkDefaultmain').click(function() {
            if ($(this).is(':checked')) {
                $('input[type=checkbox]').prop('checked', true);
            } else {
                $('input[type=checkbox]').prop('checked', false);
            }
        });

        $('.group-checkbox').click(function() {
            var group = $(this).data('group');
            $('.permission-checkbox-' + group).prop('checked', $(this).is(':checked'));
        });
    </script>
@endsection
