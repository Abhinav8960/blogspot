<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('home.homecss')
</head>

<body>

    <div class="header_section">
        @include('home.header')
    </div>

    {{-- Blogs Section --}}
    <div class="services_section layout_padding my-posts-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="services_taital m-0">My Blogs</h1>

                <a href="{{ auth()->user()->isAdmin() ? route('admin.blogs.index') : route('blogs.create') }}" class="btn btn-warning text-dark">
                    + Add Blog
                </a>
            </div>
            <div class="services_section_2">
                <div class="row">
                    @foreach($blogs as $blog)
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('home.userblogsdetail', $blog->id) }}" class="card-link">
                            <div class="post-card">
                                <div class="post-image">
                                    @if($blog->featured_image)
                                    <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}">
                                    @else
                                    <div class="no-image">
                                        <i class="fa fa-image"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="post-content">
                                    <h4>{{ $blog->title }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('home.footer')

</body>

</html>