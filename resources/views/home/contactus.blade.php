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

    {{-- Contact Us Section Section --}}
    <div class="contact_section layout_padding">
        <div class="container">
            <h1 class="contact_taital">Request A Call Back</h1>

            <form ... novalidate action="{{ route('Contactuscreate') }}" method="POST" class="contact-form">
                @csrf

                <div class="email_text">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Name" class="email-bt">
                        <small class="text-danger error-name"></small>
                    </div>

                    <div class="form-group">
                        <input type="text" name="phone" placeholder="Phone Number" class="email-bt">
                        <small class="text-danger error-phone"></small>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" class="email-bt">
                        <small class="text-danger error-email"></small>
                    </div>

                    <div class="form-group">
                        <textarea
                            name="message"
                            rows="5"
                            placeholder="Message"
                            class="massage-bt">{{ old('message') }}</textarea>
                        <small class=" text-danger error-message"></small>
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


    @include('home.footer')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelector('.contact-form').addEventListener('submit', function(e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);
            let btn = form.querySelector('button');

            btn.disabled = true;
            btn.innerText = "Sending...";

            // clear old errors + remove red borders
            document.querySelectorAll('.error-name, .error-phone, .error-email, .error-message')
                .forEach(el => el.innerText = '');

            form.querySelectorAll('input, textarea').forEach(el => {
                el.classList.remove('border-danger');
            });

            fetch("{{ route('Contactuscreate') }}", {
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

                        if (errors.name) {
                            document.querySelector('.error-name').innerText = errors.name[0];
                            form.querySelector('[name="name"]').classList.add('border-danger');
                        }

                        if (errors.phone) {
                            document.querySelector('.error-phone').innerText = errors.phone[0];
                            form.querySelector('[name="phone"]').classList.add('border-danger');
                        }

                        if (errors.email) {
                            document.querySelector('.error-email').innerText = errors.email[0];
                            form.querySelector('[name="email"]').classList.add('border-danger');
                        }

                        if (errors.message) {
                            document.querySelector('.error-message').innerText = errors.message[0];
                            form.querySelector('[name="message"]').classList.add('border-danger');
                        }

                    } else {

                        Swal.fire({
                            icon: 'success',
                            title: 'Sent!',
                            text: res.body.message || 'We will contact you shortly.',
                            confirmButtonColor: '#2b2278'
                        });

                        form.reset();
                    }

                    btn.disabled = false;
                    btn.innerText = "SUBMIT";
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: data.message || 'Something went wrong.',
                        confirmButtonColor: '#2b2278'
                    });

                    btn.disabled = false;
                    btn.innerText = "SUBMIT";
                });
        });
    </script>

</body>

</html>