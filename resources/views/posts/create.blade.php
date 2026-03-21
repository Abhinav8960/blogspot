<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<body>
    <header class="header">
        @include('admin.header')
    </header>
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <h1 class="post_title">Create Post</h1>

            <div class="post-form-wrapper">
                <form action="{{route('admin.posts.store')}}" method="POST" class="post-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter title">
                        <small class="text-danger error-title"></small>
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Enter description"></textarea>
                        <small class="text-danger error-description"></small>
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control-file">
                        <small class="text-danger error-image"></small>
                    </div>

                    <div class="form-group text-right">
                        <input type="submit" class="btn btn-warning px-4" value="Submit">
                    </div>

                </form>
            </div>

        </div>
        @include('admin.footer')
    </div>
    <!-- JavaScript files-->
    @include('admin.js')

    <script>
        document.querySelector('.post-form').addEventListener('submit', function(e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);

            // clear old errors
            document.querySelectorAll('.error-title, .error-description, .error-image')
                .forEach(el => el.innerText = '');
            fetch("{{ route('posts.store') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {

                    if (!data.status) {
                        let errors = data.errors;

                        if (errors.title) {
                            document.querySelector('.error-title').innerText = errors.title[0];
                        }
                        if (errors.description) {
                            document.querySelector('.error-description').innerText = errors.description[0];
                        }
                        if (errors.image) {
                            document.querySelector('.error-image').innerText = errors.image[0];
                        }

                    } else {
                        window.location.href = "{{ route('posts.index') }}";
                    }
                })
                .catch(err => console.log(err));
        });
    </script>
</body>

</html>