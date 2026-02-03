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

    {{-- About Section --}}
    @include('home.about')

    @include('home.footer')

</body>
</html>
