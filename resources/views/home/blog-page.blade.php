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

    {{-- Blog Section --}}
    @include('home.blog')

    @include('home.footer')

</body>
</html>
