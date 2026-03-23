<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<body>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const echo = new Echo({
                broadcaster: 'reverb',
                host: window.location.hostname + ':8080',
                authEndpoint: '/broadcasting/auth',
                withCredentials: true,
            });

            echo.private('App.Models.User.{{ auth()->id() }}')
                .notification((data) => {

                    console.log("🔥 Notification received:", data);

                    Swal.fire({
                        icon: 'info',
                        title: 'New Contact!',
                        text: data.name + " sent a message",
                        confirmButtonColor: '#2b2278'
                    });

                });

        });
    </script>

    <header class="header">

        @include('admin.header')
    </header>
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            @include('admin.body')
            @include('admin.footer')
        </div>

    </div>
    <!-- JavaScript files-->
    @include('admin.js')
</body>

</html>