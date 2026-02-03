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
                        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                    </div>
                    @endif
                </div>

                {{-- Content Column --}}
                <div class="col-md-7 mt-5">
                    <div class="post-card">

                        <h2 class="mb-2 post-title">
                            {{ $post->title }}
                        </h2>


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

</body>

</html>