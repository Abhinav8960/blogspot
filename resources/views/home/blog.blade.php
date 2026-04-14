<div class="blog_section home-blog-section">
    <div class="container text-center">

        <h1 class="home-blog-title">Blogs</h1>
        <!-- <h3 class="home-blog-subtitle">See Our Video</h3> -->

        <!-- <p class="home-blog-text mx-auto">
            Many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
            in some form, by injected humour or randomised words.
        </p> -->

        <div class="services_section_2">
            <div class="row">

                @forelse($blogs as $blog)
                <div class="col-md-4 mb-4">
                    <a href="{{ route('home.userblogsdetail', $blog->id) }}"
                        class="card-link text-decoration-none">

                        <div class="post-card">

                            <div class="post-image">
                                @if($blog->featured_image)
                                <img src="{{ $blog->featured_image }}"
                                    alt="{{ $blog->title }}"
                                    class="img-fluid">
                                @else
                                <div class="no-image d-flex align-items-center justify-content-center">
                                    <i class="fa fa-image"></i>
                                </div>
                                @endif
                            </div>

                            <div class="post-content">
                                <h4 class="mb-2">{{ $blog->title }}</h4>

                                <p class="post-author mb-0 text-muted">
                                    By {{ $blog->user->name ?? 'Unknown' }}
                                </p>
                            </div>

                        </div>
                    </a>
                </div>

                @empty
                <div class="col-12">
                    <p class="text-center">No blogs available.</p>
                </div>
                @endforelse

            </div>
        </div>

    </div>
</div>