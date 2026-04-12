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


            <div class="d-flex justify-content-between align-items-center page-content-heading">

                <h1 class="post_title">Pending Blogs for Approval</h1>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary  mt-3 mr-4">
                    Go back to list
                </a>
            </div>

            @include('admin.blogs.search')



            <table class="table table-striped custom-table">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($blogs as $blog)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $blog->user->name }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>
                            @if($blog->featured_image)
                            <img src="{{($blog->featured_image) }}" width="80">
                            @else
                            No Image
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $blog->status_meta['class'] }}">
                                {{ $blog->status_meta['label'] }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('admin.blogs.view', $blog->id) }}" class="btn btn-sm btn-warning">View</a>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No Blogs found
                            @if(request('search'))
                            for "{{ request('search') }}"
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>


            <div class="d-flex justify-content-center mt-4">
                {{ $blogs->links() }}
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
                    title: "Are you sure to delete this blog ? ",
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