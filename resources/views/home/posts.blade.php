<div class="services_section layout_padding">
    <div class="container">
        <h1 class="services_taital">Posts</h1>
        <p class="services_text">Fresh posts, useful tips, and stories worth your time. Dive in and explore.</p>
        <div class="services_section_2">
            <div class="row">
                @foreach($posts as $post)
                <div class="col-md-4 mb-4">
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
                                <p class="post-author">By {{ $post->user->name ?? 'Unknown' }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>