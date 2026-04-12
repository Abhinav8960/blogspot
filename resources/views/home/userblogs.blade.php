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

            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap" style="gap:15px;">
                <h1 class="services_taital m-0">My Blogs</h1>

                <div class="d-flex align-items-center flex-wrap" style="gap:10px;">

                    {{-- Filter Buttons --}}
                    <a href="{{ route('home.userblogs', Auth::id()) }}"
                        class="btn {{ request('status') == '' ? 'btn-dark' : 'btn-outline-dark' }}"
                        style="border-radius:20px; font-size:13px; font-weight:500;">
                        All
                    </a>

                    <a href="{{ route('home.userblogs', ['id' => Auth::id(), 'status' => 'published']) }}"
                        class="btn {{ request('status') == 'published' ? 'btn-dark' : 'btn-outline-dark' }}"
                        style="border-radius:20px; font-size:13px; font-weight:500;">
                        ✓ Published
                    </a>

                    <a href="{{ route('home.userblogs', ['id' => Auth::id(), 'status' => 'pending']) }}"
                        class="btn {{ request('status') == 'pending' ? 'btn-dark' : 'btn-outline-dark' }}"
                        style="border-radius:20px; font-size:13px; font-weight:500;">
                        ● Pending
                    </a>

                    <a href="{{ route('home.userblogs', ['id' => Auth::id(), 'status' => 'rejected']) }}"
                        class="btn {{ request('status') == 'rejected' ? 'btn-dark' : 'btn-outline-dark' }}"
                        style="border-radius:20px; font-size:13px; font-weight:500;">
                        ✗ Rejected
                    </a>

                    <a href="{{ route('home.userblogs', ['id' => Auth::id(), 'status' => 'draft']) }}"
                        class="btn {{ request('status') == 'draft' ? 'btn-dark' : 'btn-outline-dark' }}"
                        style="border-radius:20px; font-size:13px; font-weight:500;">
                        ● Draft
                    </a>

                    <a href="{{ route('blogs.create') }}" class="btn btn-warning text-dark" style="border-radius:20px; font-weight:500;">
                        + Add Blog
                    </a>

                    <a href="{{ route('home.userblogspendingforapproval', Auth::id()) }}"
                        class="btn btn-secondary"
                        style="border-radius:20px; font-weight:500;">
                        Blogs Pending for Approval
                    </a>

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
                        <p>No blogs found for this status.</p>
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

</body>

</html>