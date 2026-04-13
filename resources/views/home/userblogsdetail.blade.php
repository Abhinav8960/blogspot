<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('home.homecss')

    <style>
        .blog_details_section {
            padding: 60px 0;
        }

        .blog-card {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .blog-image img,
        .blog-video video,
        .blog-video iframe {
            border-radius: 10px;
            width: 100%;
            object-fit: cover;
        }

        .blog-meta {
            font-size: 14px;
            color: #777;
            margin-bottom: 15px;
        }

        .blog-content {
            line-height: 1.8;
            color: #444;
            font-size: 15px;
        }

        .blog-title {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .blog-excerpt {
            background: #f8f9fa;
            padding: 15px;
            border-left: 4px solid #222;
            border-radius: 8px;
            margin-bottom: 20px;
            color: #555;
            font-style: italic;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-draft {
            background: #e9ecef;
            color: #495057;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }

        .action-buttons {
            gap: 10px;
            flex-wrap: wrap;
        }

        .edit-btn {
            opacity: 1 !important;
            visibility: visible !important;
            display: inline-block !important;
            color: #000 !important;
        }

        .edit-btn i {
            color: #000 !important;
        }
    </style>
</head>

<body>

    <div class="header_section">
        @include('home.header')
    </div>

    <div class="blog_details_section">
        <div class="container mt-5">
            <div class="row align-items-start">

                <div class="col-md-5 mb-4 mt-5">
                    @if($blog->featured_image)
                    <div class="blog-image mb-4">
                        <img src="{{($blog->featured_image) }}" alt="{{ $blog->title }}">
                    </div>
                    @endif

                    @if($blog->featured_video)
                    <div class="blog-video">
                        @if(Str::contains($blog->featured_video, ['youtube.com', 'youtu.be']))
                        <iframe
                            src="{{ $blog->featured_video }}"
                            height="300"
                            frameborder="0"
                            allowfullscreen>
                        </iframe>
                        @else
                        <video controls>
                            <source src="{{ ($blog->featured_video) }}" alt="{{ $blog->title }}">
                            Your browser does not support the video tag.
                        </video>
                        @endif
                    </div>
                    @endif
                </div>

                <div class="col-md-7 mt-5">
                    <div class="blog-card">

                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h2 class="blog-title mb-2">{{ $blog->title }}</h2>

                                <span class="status-badge 
                                    @if($blog->status == 'draft') status-draft
                                    @elseif($blog->status == 'pending') status-pending
                                    @elseif($blog->status == 'approved') status-approved
                                    @elseif($blog->status == 'published') status-published
                                    @elseif($blog->status == 'rejected') status-rejected
                                    @endif">
                                    {{ $blog->status }}
                                </span>
                            </div>

                            @auth
                            @if((auth()->id() == $blog->user_id || auth()->user()->isAdmin()) && ( $blog->status == 'draft' || $blog->status == 'rejected'))
                            <a href="{{ route('home.blogsedit', $blog->id) }}"
                                class="btn btn-sm btn-outline-dark edit-btn">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            @endif
                            @endauth
                        </div>

                        <h5>By {{ $blog->user->name ?? 'Unknown' }}</h5>

                        <div class="blog-meta">
                            Posted on {{ $blog->created_at->format('d M Y') }}
                        </div>

                        @if($blog->excerpt)
                        <div class="blog-excerpt">
                            {{ $blog->excerpt }}
                        </div>
                        @endif

                        <div class="blog-content">
                            {!! nl2br(e($blog->content)) !!}
                        </div>

                        @if($blog->status == 'rejected' && $blog->rejection_reason)
                        <div class="alert alert-danger mt-4">
                            <strong>Rejection Reason:</strong> {{ $blog->rejection_reason }}
                        </div>
                        @endif

                        @auth
                        @if(auth()->id() == $blog->user_id)
                        <div class="d-flex action-buttons mt-4">

                            @if($blog->status == 'draft' || $blog->status == 'rejected')
                            <form action="{{ route('home.blogsendforapproval', $blog->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning">
                                    Send for Approval
                                </button>
                            </form>


                            <form action="{{ route('home.blogdestroy', $blog->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this blog?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                            @endif
                            <a href="{{ route('home.userblogs', auth()->id()) }}" class="btn btn-dark">
                                Back to My Blogs
                            </a>
                        </div>
                        @else
                        <a href="{{ route('home') }}" class="btn btn-dark mt-4">
                            ← Go Back
                        </a>
                        @endif
                        @else
                        <a href="{{ route('home') }}" class="btn btn-dark mt-4">
                            ← Go Back
                        </a>
                        @endauth

                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('home.footer')

</body>

</html>