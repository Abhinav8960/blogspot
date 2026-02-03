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
            <h1 class="post_title">Create Post</h1>

            <div class="post-form-wrapper">
                <form action="{{route('posts.store')}}" method="POST" class="post-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter title">
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Enter description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control-file">
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