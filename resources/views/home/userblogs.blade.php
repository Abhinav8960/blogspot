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

    <div class="services_section layout_padding my-posts-section">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center mb-3" style="gap:15px;">
                <h1 class="services_taital m-0">My Blogs</h1>

                <div class="d-flex align-items-center" style="gap:10px;">

                    <a href="{{ route('blogs.create') }}"
                        class="btn btn-warning text-dark"
                        style="border-radius:20px; font-weight:500;">
                        + Add Blog
                    </a>

                    <!-- <a href="{{ route('home.userblogspendingforapproval', Auth::id()) }}"
                        class="btn btn-secondary"
                        style="border-radius:20px; font-weight:500;">
                        Blogs Pending for Approval
                    </a> -->


                    @php
                    $status = request('status');
                    $label = match($status) {
                    'published' => 'Published',
                    'pending' => 'Pending',
                    'rejected' => 'Rejected',
                    'draft' => 'Draft',
                    'approved' => 'Approved',
                    default => 'All Blogs',
                    };
                    @endphp

                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle"
                            type="button"
                            id="blogFilterDropdown"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            style="border-radius:30px; font-size:15px; font-weight:500; height: 40px;">
                            {{ $label }}
                        </button>

                        <ul class="dropdown-menu" style="border-radius:30px; background-color: #66b2c5" aria-labelledby="blogFilterDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('home.userblogs', Auth::id()) }}">
                                    All Blogs
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('home.userblogs', ['id' => Auth::id(), 'status' => 'published']) }}">
                                    Published
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('home.userblogs', ['id' => Auth::id(), 'status' => 'pending']) }}">
                                    Pending
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('home.userblogs', ['id' => Auth::id(), 'status' => 'rejected']) }}">
                                    Rejected
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('home.userblogs', ['id' => Auth::id(), 'status' => 'draft']) }}">
                                    Draft
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('home.userblogs', ['id' => Auth::id(), 'status' => 'approved']) }}">
                                    Approved
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="services_section_2">
                <div class="row">
                    @forelse($blogs as $blog)
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

                                <div class="d-flex justify-content-between align-items-center post-content">
                                    <h4>{{ $blog->title }}</h4>
                                    {!! $blog->getStatusBadge() !!}
                                </div>
                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p>No blogs found.</p>
                    </div>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>

    @include('home.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>