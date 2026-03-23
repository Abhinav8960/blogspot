<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('home.homecss')


</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        @include('home.header')
    </div>
    <!-- header section end -->

    <!-- post details section start -->
    <div class="contact_section layout_padding">
        <div class="container">
            <h1 class="contact_taital">Edit Post</h1>
            <form novalidate action="{{ route('home.userpostsupdate', $post->id) }}" method="POST" class="contact-form" enctype="multipart/form-data">
                @csrf
                <div class="email_text">
                    <div class="form-group">
                        <input type="text" name="title" placeholder="Title" class="email-bt" value="{{$post->title}}">
                        <small class="text-danger error-title"></small>
                    </div>

                    <div class="form-group">
                        <textarea
                            name="description"
                            rows="5"
                            placeholder="Description"
                            class="massage-bt">{{$post->description}}</textarea>
                        <small class=" text-danger error-description"></small>
                    </div>


                    <div class="form-group">
                        @if($post->image)
                        <div class="mb-2">
                            <img src="{{ ($post->image) }}" alt="Post Image"
                                style="width:200px; height:auto; border:1px solid #050505ff; padding:4px;">
                        </div>
                        @endif
                        <input type="file" name="image" placeholder="Image" class="email-bt">
                        <small class="text-danger error-image"></small>
                    </div>



                    <div class="btn_main">
                        <button type="submit" class="btn btn-dark">
                            SUBMIT
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
    <!-- post details section end -->

    @include('home.footer')


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelector('.contact-form').addEventListener('submit', function(e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);
            let btn = form.querySelector('button');

            btn.disabled = true;
            btn.innerText = "Submitting...";

            // clear old errors + remove red borders
            document.querySelectorAll('.error-title, .error-description, .error-image')
                .forEach(el => el.innerText = '');

            form.querySelectorAll('input, textarea').forEach(el => {
                el.classList.remove('border-danger');
            });

            fetch("{{ route('home.userpostsupdate', $post->id) }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(async res => {
                    let data = await res.json();
                    return {
                        status: res.status,
                        body: data
                    };
                })
                .then(res => {

                    let errors = res.body.errors || {};

                    if (res.status !== 200) {

                        if (errors.title) {
                            document.querySelector('.error-title').innerText = errors.title[0];
                            form.querySelector('[name="title"]').classList.add('border-danger');
                        }

                        if (errors.description) {
                            document.querySelector('.error-description').innerText = errors.description[0];
                            form.querySelector('[name="description"]').classList.add('border-danger');
                        }

                        if (errors.image) {
                            document.querySelector('.error-image').innerText = errors.image[0];
                            form.querySelector('[name="image"]').classList.add('border-danger');
                        }

                    } else {

                        Swal.fire({
                            icon: 'success',
                            title: 'Sent!',
                            text: res.body.message || 'We will contact you shortly.',
                            confirmButtonColor: '#89D8FC'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('home.userposts', auth()->id()) }}";
                            }
                        });
                    }

                    btn.disabled = false;
                    btn.innerText = "SUBMIT";
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: data.message || 'Something went wrong.',
                        confirmButtonColor: '#89D8FC'
                    });

                    btn.disabled = false;
                    btn.innerText = "SUBMIT";
                });
        });
    </script>

</body>

</html>