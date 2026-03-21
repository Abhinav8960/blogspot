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

    {{-- Posts Section --}}
    <div class="services_section layout_padding my-posts-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="services_taital m-0">My Posts</h1>

                <a href="{{ route('posts.create') }}" class="btn btn-warning text-dark">
                    + Add Post
                </a>
            </div>
            <div class="services_section_2">
                <div class="row">
                    @foreach($myposts as $post)
                    <div class="col-md-3 mb-3">
                        <a href="{{ url('postdetails', $post->id) }}" class="card-link">
                            <div class="post-card">
                                <div class="post-image">
                                    @if($post->image)
                                    <img src="{{ $post->image }}" alt="{{ $post->title }}">
                                    @else
                                    <div class="no-image">
                                        <i class="fa fa-image"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="post-content">
                                    <h4>{{ $post->title }}</h4>
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