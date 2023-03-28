@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit roles permissions </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit roles permissions</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">

                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">

                            <form id="myForm" method="post" action="{{ route('roles.permissions.store') }}">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Roles Name</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="name" value="{{ $roles->name }}">
                                    </div>

                                    <div class="ps-2">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="flexCheckDefaultAll">
                                            <label for="flexCheckDefaultAll" class="form-check-label">Permissions All</label>
                                        </div>
                                    </div>


                                    <hr class="mt-5">

                                    @foreach($permissions_groups as $group)
                                    <div class="row">

                                        <div class="col-3">

                                            @php
                                            $permissions = App\Models\User::getPermissionsByGroupName($group->group_name);
                                            @endphp

                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" {{ App\Models\User::rolesHasPermissions($roles, $permissions) ? 'checked' : '' }} id="flexCheckDefault">
                                                <label for="flexCheckDefault" class="form-check-label">{{ $group->group_name }}</label>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            @php
                                            $permissions = App\Models\User::getPermissionsByGroupName($group->group_name);
                                            @endphp

                                            @foreach($permissions as $permission)

                                            <div class="form-check">
                                                <input type="checkbox" name="permissions[]" {{ $roles->hasPermissionTo($permission->name) ? 'checked' : '' }} value="{{ $permission->id }}" class="form-check-input" id="flexCheckDefault{{ $permission->id }}">
                                                <label for="flexCheckDefault{{ $permission->id }}" class="form-check-label">{{ $permission->name }}</label>
                                            </div>

                                            @endforeach
                                        </div>

                                    </div>
                                    @endforeach
                                </div>


                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                    </div>
                                </div>
                        </div>

                        </form>



                    </div>




                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $('#flexCheckDefaultAll').click(function() {
        if ($(this).is(':checked')) {
            $('input[type = checkbox]').prop('checked', true)
        } else {
            $('input[type = checkbox]').prop('checked', false)
        }
    });

</script>







@endsection
