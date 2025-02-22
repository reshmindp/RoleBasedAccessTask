@extends('app.layouts.master')
@section('content')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Users</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Users</a></li>
                                            <li class="breadcrumb-item active">Add User</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Add User</h4>

                                        <form action="{{route('users.store')}}" id="userForm" enctype="multipart/form-data" method="POST">
                                            @csrf
                                            <div class="row">   
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Name @error('name') <span class="text-danger"> {{ $message }} </span> @enderror</label>
                                                        <input type="text" name="name" maxlength="200" value="{{old('name')}}" class="form-control" placeholder="Enter name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Email @error('email') <span class="text-danger"> {{ $message }} </span> @enderror</label>
                                                        <input type="text" name="email" maxlength="200" value="{{old('email')}}" class="form-control" placeholder="Enter email">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Password @error('password') <span class="text-danger"> {{ $message }} </span> @enderror</label>
                                                        <input type="password" name="password" maxlength="200" value="{{old('password')}}" class="form-control" placeholder="Enter password">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Permissions @error('permissions.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                            @error('permissions') <span class="text-danger"> {{ $message }} </span> @enderror</label>
                                                        <select class="select2 form-control select2-multiple"
                                                        multiple="multiple" name="permissions[]" data-placeholder="Choose ...">
                                                        <optgroup label="Select permissions">
                                                            @foreach($permissions as $permission)
                                                            <option value="{{$permission->id}}" {{ collect(old('permissions'))->contains($permission->id) ? 'selected' : '' }}>{{$permission->name}}</option>
                                                            @endforeach
                                                        </optgroup>    
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary w-md">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                @include('app.layouts.footer')
            </div>
            <!-- end main content-->

@endsection
