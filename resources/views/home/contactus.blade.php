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
                        class="email-bt"
                        placeholder="Name"
                        name="name"
                        required
                    >
                </div>

                <div class="form-group">
                    <input
                        type="text"
                        class="email-bt"
                        placeholder="Phone Number"
                        name="phone"
                        required
                    >
                </div>

                <div class="form-group">
                    <input
                        type="email"
                        class="email-bt"
                        placeholder="Email"
                        name="email"
                        required
                    >
                </div>

                <div class="form-group">
                    <textarea
                        class="massage-bt"
                        placeholder="Message"
                        rows="5"
                        name="message"
                        required
                    ></textarea>
                </div>

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