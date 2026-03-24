<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('home.homecss')

    <style>
        /* Post section background */
        .post_details_section {

            padding: 60px 0;
            /* better spacing from header */
        }

        .post-card {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .post-image img {
            border-radius: 10px;
            width: 100%;
            object-fit: cover;
        }

        .post-meta {
            font-size: 14px;
            color: #777;
            margin-bottom: 15px;
        }

        .post-content {
            line-height: 1.8;
            color: #444;
            font-size: 15px;
        }

        .post-title {
            font-size: 36px;
            font-weight: 700;
        }
    </style>
</head>

<body>

    <!-- header section start -->
    <div class="header_section">
        @include('home.header')
    </div>
    <!-- header section end -->

    <!-- post details section start -->
    <div class="post_details_section">
        <div class="container mt-5 ">
            <div class="row align-items-start">

                {{-- Image Column --}}
                <div class="col-md-5 mb-4 mt-5">
                    @if($post->image)
                    <div class="post-image">
                        <img src="{{($post->image) }}" alt="{{ $post->title }}">
                    </div>
                    @endif
                </div>

                {{-- Content Column --}}
                <div class="col-md-7 mt-5">
                    <div class="post-card">


                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h2 class="post-title mb-0">
                                {{ $post->title }}
                            </h2>

                            @auth
                            @if(auth()->id() == $post->user_id)
                            <a href="{{ auth()->user()->isAdmin() ? route('admin.posts.index') :  route('home.userpostsedit', $post->id) }}" class="btn btn-sm btn-outline-dark edit-btn">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            @endif
                            @endauth
                        </div>

                        <h3>By {{$post->user->name ?? 'unknown'}}</h3>

                        <div class="post-meta">
                            Posted on {{ $post->created_at->format('d M Y') }}
                        </div>

                        <div class="post-content text-xl">
                            {!! nl2br(e($post->description)) !!}
                        </div>

                        <a href="{{ route('home') }}" class="btn btn-dark mt-4">
                            ← Go Back
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- post details section end -->

    @include('home.footer')
    <style>
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
</body>

</html>