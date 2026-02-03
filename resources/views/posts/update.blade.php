<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<body>
    <header class="header">
        @include('admin.header')
    </header>
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <h1 class="post_title">Update Post</h1>

            <div class="post-form-wrapper">
                <form action="{{route('posts.update', $post->id)}}" method="POST" class="post-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter title" value="{{$post->title}}">
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Enter description" value=""> {{$post->description}}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image</label>

                        @if($post->image)
                        <div class="mb-2">
                            <img src="{{ asset($post->image) }}" alt="Post Image"
                                style="width:200px; height:auto; border:1px solid #050505ff; padding:4px;">
                        </div>
                        @endif

                        <input type="file" name="image" class="form-control-file ">
                    </div>


                    <div class="form-group text-right">
                        <input type="submit" class="btn btn-warning px-4" value="Submit">
                    </div>

                </form>
            </div>

        </div>
        @include('admin.footer')
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
</body>

</html>