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

            <form action="{{ route('Contactuscreate') }}" method="POST">
                @csrf

                <div class="email_text">
                    <div class="form-group">
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Name"
                            class="email-bt @error('name') input-error @enderror">

                    </div>
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror


                    <div class="form-group">
                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="Phone Number"
                            class="email-bt @error('phone') input-error @enderror">

                    </div>
                    @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <div class="form-group">
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Email"
                            class="email-bt @error('email') input-error @enderror">

                    </div>

                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror


                    <div class="form-group">
                        <textarea
                            name="message"
                            rows="5"
                            placeholder="Message"
                            class="massage-bt @error('message') input-error @enderror">{{ old('message') }}</textarea>

                    </div>

                    @error('message')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <div class="btn_main">
                        <button type="submit" class="btn btn-dark">
                            SEND
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @include('home.footer')

</body>

</html>

 