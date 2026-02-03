    <div class="services_section layout_padding">
        <div class="container">
            <h1 class="services_taital">Posts </h1>
            <p class="services_text">Fresh posts, useful tips, and stories worth your time. Dive in and explore.</p>
            <div class="services_section_2">
                <div class="row">
                    @foreach($posts as $post)
                    <div class="col-md-4">

                        @if($post->image)
                        <div><img src="{{ asset($post->image) }}" class="services_img"></div>
                        @else
                        No Image
                        @endif

                        <h4>{{$post->title}}</h4>
                        <p>By {{$post->user_id}}</p>
                        <div class="btn_main"><a href="{{url('postdetails',$post->id)}}">Read More</a></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>