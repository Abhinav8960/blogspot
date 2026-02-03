<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('images/banner-bg.png') }}') no-repeat center center/cover;">
    <div class="w-full sm:max-w-md px-6 py-8 bg-white bg-opacity-90 shadow-lg overflow-hidden sm:rounded-lg">
        <div class="text-center mb-8">
            {{ $logo }}
        </div>
        {{ $slot }}
    </div>
</div>
