<!DOCTYPE html>
<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
            @foreach (['success', 'danger', 'warning', 'info'] as $msg)
            @if(session($msg))
            <div class="alert alert-{{ $msg }} alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session($msg) }}
            </div>
            @endif
            @endforeach


            <div class="d-flex justify-content-between align-items-center">

                <h1 class="post_title">Posts</h1>
                <a href="{{ route('posts.create') }}" class="btn btn-primary  mt-3 mr-4">
                    Create Post
                </a>
            </div>

                 @include('posts.search')

                
 
            <table class="table table-striped custom-table">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ Str::limit($post->description, 50) }}</td>
                        <td>
                            @if($post->image)
                            <img src="{{ asset($post->image) }}" width="80">
                            @else
                            No Image
                            @endif
                        </td>
                        <td>{{ $post->created_at }}</td>
                        <td>
                            <span class="badge {{ $post->status_meta['class'] }}">
                                {{ $post->status_meta['label'] }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            @if( $post->status != -1 )
                            <form action="{{ route('posts.delete', $post->id) }}"
                                method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="confirmation(event)">
                                    Delete
                                </button>
                            </form>
                            @endif
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No posts found
                            @if(request('search'))
                            for "{{ request('search') }}"
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>


            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links() }}
            </div>

        </div>

        @include('admin.footer')
    </div>
    <!-- JavaScript files-->
    @include('admin.js')

    <script>
        function confirmation(ev) {
            ev.preventDefault();
            let form = ev.target.closest('form');
            swal({
                    title: "Are you sure to delete this post ? ",
                    text: "You wont able to revert this action!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })

                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        }
    </script>
</body>

</html>