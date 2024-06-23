@extends('layoutslte.template')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Roles in Permission</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="w-100">
                        <div class="card">
                            <div id="container-table" class="overflow-hidden">
                                <div class="card-body">
                                    <form action="{{ route('active.roles.update', $role->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="naam_role" class="form-label">Nama Role</label>
                                            <h3>{{ $role->name }}</h3>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkDefaultmain">
                                            <label class="form-check-label" for="checkDefaultmain">Pilih semua
                                                permission</label>
                                        </div>

                                        <hr>

                                        @foreach ($permission_groups as $group)
                                            <div class="row">
                                                <div class="col-3">
                                                    @php
                                                        $permissions = App\Models\User::getPermissionByGroupName(
                                                            $group->group_name,
                                                        );
                                                    @endphp
                                                    <div class="form-check">
                                                        <input class="form-check-input group-checkbox" type="checkbox"
                                                            id="groupCheck{{ $group->group_name }}"
                                                            data-group="{{ $group->group_name }}"
                                                            {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="groupCheck{{ $group->group_name }}">{{ $group->group_name }}</label>
                                                    </div>
                                                </div>

                                                <div class="col-9">
                                                    @foreach ($permissions as $permission)
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input permission-checkbox-{{ $group->group_name }}"
                                                                name="permission[]" id="checkDefault{{ $permission->id }}"
                                                                value="{{ $permission->name }}" type="checkbox"
                                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        $('#checkDefaultmain').click(function() {
            $('input[type=checkbox]').prop('checked', $(this).is(':checked'));
        });

        $('.group-checkbox').click(function() {
            var group = $(this).data('group');
            $('.permission-checkbox-' + group).prop('checked', $(this).is(':checked'));
        });
    </script>
@endsection
