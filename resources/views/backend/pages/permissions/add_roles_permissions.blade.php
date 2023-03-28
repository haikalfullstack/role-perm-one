@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add roles permissions </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add roles permissions</li>
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

                            <form id="myForm" method="post" action="{{ route('store.roles') }}">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Roles Name</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <select name="" id="" class="form-select mb-3">
                                            <option selected="">Open this select menu</option>
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <hr class="mt-5">

                                    @foreach($permissions_groups as $group)
                                    <div class="row">

                                        <div class="col-3">



                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="flexCheckDefault">
                                                <label for="flexCheckDefault" class="form-check-label">{{ $group->group_name }}</label>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="flexCheckDefault1">
                                                <label for="flexCheckDefault1" class="form-check-label">dfault</label>
                                            </div>
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
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                name: {
                    required: true
                , }
            , }
            , messages: {
                category_name: {
                    required: 'Please Enter Roles Name'
                , }
            , }
            , errorElement: 'span'
            , errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            }
            , highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            }
            , unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        , });
    });

</script>







@endsection