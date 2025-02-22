@extends('app.layouts.master')
@section('content')
@push('custom-scripts')
<script>
    function confirmDelete(event, form) {
       event.preventDefault();

       if (confirm("Are you sure you want to delete the Post?")) {
           form.submit();
       }
   }
</script>   
@endpush
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
                                            <li class="breadcrumb-item"><a>Modules</a></li>
                                            <li class="breadcrumb-item active">Posts</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <div class="d-flex justify-content-between align-items-center" data-kt-subscription-table-toolbar="base">
                                            <h4 class="mb-sm-0 font-size-18">All Posts</h4>
                                            @can('create post')
                                            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i> Add Post</a>
                                            @endcan
                                        </div>
                                       
                                        <div class="mb-4"></div>
        
                                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>Sl #</th>
                                                <th>Categories</th>
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @foreach($posts as $post)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td> @if($post->categories->isNotEmpty())
                                                    {{ $post->categories->pluck('name')->join(', ') }} 
                                                @else
                                                    <span class="text-muted">No Categories</span>
                                                @endif</td>
                                                <td>{{ $post->title }}</td>
                                                <td> <img width="200" src="{{asset('storage/'.$post->image)}}">
                                                </td>
                                                <td>{{$post->description}}</td>
                                                <td>
                                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                                        @can('edit post')
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <a href="{{route('posts.edit', $post->id)}}" class="btn btn-sm btn-soft-warning"><i class="mdi mdi-pencil-outline"></i></a>
                                                        </li>
                                                        @endcan
                                                        @can('delete post')
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-soft-danger" onclick="confirmDelete(event, this.closest('form'))"><i class="mdi mdi-delete-outline"></i></button>
                                                            </form>
                                                        </li>
                                                        @endcan
                                                    </ul>
                                                </td>
                                            </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                @include('app.layouts.footer')
            </div>
            <!-- end main content-->
@endsection