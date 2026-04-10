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

    <div class="contact_section layout_padding">
        <div class="container">
            <h1 class="contact_taital">Update Blog</h1>

            @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form novalidate action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="contact-form">
                @csrf
                @method('POST')

                <div class="email_text">

                    <div class="form-group mb-3">
                        <input type="text"
                            name="title"
                            value="{{ old('title', $blog->title) }}"
                            placeholder="Blog Title"
                            class="email-bt @error('title') border-danger @enderror">
                        @error('title')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <textarea name="excerpt"
                            rows="3"
                            placeholder="Short excerpt (optional)"
                            class="massage-bt @error('excerpt') border-danger @enderror">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        @error('excerpt')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <textarea name="content"
                            rows="8"
                            placeholder="Write your blog content here..."
                            class="massage-bt @error('content') border-danger @enderror">{{ old('content', $blog->content) }}</textarea>
                        @error('content')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <input type="file"
                            name="featured_image"
                            class="email-bt @error('featured_image') border-danger @enderror">
                        @error('featured_image')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror

                        @if($blog->featured_image)
                        <div class="d-flex mt-2">
                            <p class="mb-1">Current Image:</p>
                            <img src="{{($blog->featured_image) }}" alt="{{ $blog->title }}" style="max-width: 200px; height: auto; border-radius: 8px;">
                        </div>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <input type="url"
                            name="featured_video"
                            value="{{ old('featured_video', $blog->featured_video) }}"
                            placeholder="Featured Video URL (optional)"
                            class="email-bt @error('featured_video') border-danger @enderror">
                        @error('featured_video')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center">

                    </div>



                    <div class="btn_main">
                        <button type="submit" class="btn btn-dark">
                            UPDATE BLOG
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('home.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelector('.contact-form').addEventListener('submit', function(e) {
            let title = document.querySelector('[name="title"]').value.trim();
            let content = document.querySelector('[name="content"]').value.trim();

            if (!title || !content) {
                e.preventDefault();

                Swal.fire({
                    icon: 'error',
                    title: 'Required Fields Missing',
                    text: 'Title and content are required.',
                    confirmButtonColor: '#89D8FC'
                });
            }
        });
    </script>

</body>

</html>