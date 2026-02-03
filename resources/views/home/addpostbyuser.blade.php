<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('home.homecss')

    
</head>

<body>
     <!-- header section start -->
    <div class="header_section">
        @include('home.header')
    </div>
    <!-- header section end -->

    <!-- post details section start -->
    <div class="post_details_section">
        <div class="container   ">
            <h1 class="post-title text-center mb-4">Add Post</h1>

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

                    <div class="form-group text-center">

                       <input type="submit" class="btn btn-dark px-4 py-2 rounded-pill" value="Submit">

                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- post details section end -->

    @include('home.footer')

</body>

</html>