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
                                    <h4 class="mb-sm-0 font-size-18">Posts</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Posts</a></li>
                                            <li class="breadcrumb-item active">Add Post</li>
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
                                        <h4 class="card-title mb-4">Add Post</h4>

                                        <form action="{{route('posts.store')}}" id="postForm" enctype="multipart/form-data" method="POST">
                                            @csrf
                                            <div class="row">   
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Title @error('title') <span class="text-danger"> {{ $message }} </span> @enderror</label>
                                                        <input type="text" name="title" maxlength="200" value="{{old('title')}}" class="form-control" placeholder="Enter title">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Categories @error('categories') <span class="text-danger"> {{ $message }} </span> @enderror</label>
                                                        <select class="select2 form-control select2-multiple"
                                                        multiple="multiple" name="categories[]" data-placeholder="Choose ...">
                                                        <optgroup label="Select categories">
                                                            @foreach($categories as $category)
                                                            <option value="{{$category->id}}" {{ collect(old('categories'))->contains($category->id) ? 'selected' : '' }}>{{$category->name}}</option>
                                                            @endforeach
                                                        </optgroup>    
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Description @error('description') <span class="text-danger"> {{ $message }} </span> @enderror</label>
                                                        <textarea rows="4" name="description" class="form-control" placeholder="Enter Description">{{old('description')}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Image @error('image') <span class="text-danger"> {{ $message }} </span> @enderror</label>
                                                        <input type="file" name="image" class="form-control">
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
