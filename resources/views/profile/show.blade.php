<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-900 leading-tight" style="color: #1f1f1f;">
                {{ __('Profile') }}
            </h2>

            <!-- Profile Dropdown Menu -->
            <div class="relative" x-data="{ open: false }" @click.away="open = false" @keydown.escape.window="open = false">
                <button type="button" @click.prevent="open = !open" class="flex items-center gap-2 px-4 py-2 rounded-lg transition" style="background: linear-gradient(135deg, #89d8fc 0%, #66b2c5 100%); color: white; font-weight: 500; border: none;">
                    <i class="fas fa-user-circle text-lg"></i>
                    <span>{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </button>

                <!-- Dropdown Content -->
                <div x-show="open" x-cloak x-transition.opacity.duration.200ms class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-100 z-50" style="display: none;">
                    <div style="background: linear-gradient(135deg, #89d8fc 0%, #66b2c5 100%); border-radius: 8px 8px 0 0;" class="px-4 py-3">
                        <p style="color: white; font-weight: 600; font-size: 0.875rem;">{{ Auth::user()->name }}</p>
                        <p style="color: rgba(255,255,255,0.8); font-size: 0.75rem; margin-top: 2px;">{{ Auth::user()->email }}</p>
                    </div>

                    <div class="py-2">
                        <a href="{{ route('home') }}" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-gray-50 transition" style="color: #1f1f1f;">
                            <i class="fas fa-home text-orange-500"></i>
                            <span>{{ __('Home') }}</span>
                        </a>

                        <a href="{{ route('home.userposts', auth()->id()) }}" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-gray-50 transition" style="color: #1f1f1f;">
                            <i class="fas fa-file-alt text-green-500"></i>
                            <span>{{ __('My Posts') }}</span>
                        </a>

                        <a href="{{ route('home.userblogs', auth()->id()) }}" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-gray-50 transition" style="color: #1f1f1f;">
                            <i class="fas fa-file-alt text-green-500"></i>
                            <span>{{ __('My Blogs') }}</span>
                        </a>

                        @if(auth()->user()->isAdmin())
                        <div style="border-top: 1px solid #eee; margin: 4px 0;"></div>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-gray-50 transition" style="color: #1f1f1f;">
                            <i class="fas fa-tachometer-alt text-purple-500"></i>
                            <span>{{ __('Admin Dashboard') }}</span>
                        </a>
                        @endif

                        <div style="border-top: 1px solid #eee; margin: 4px 0;"></div>

                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm hover:bg-gray-50 transition" style="color: #dc3545; border: none; background: none; font-family: inherit; cursor: pointer;">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>{{ __('Logout') }}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div>
                <livewire:profile.update-profile-information-form />
            </div>

            <div>
                <livewire:profile.update-password-form />
            </div>

            <!-- Subscription Form Component -->
            <div>
                @include('profile.subscription-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <div>
                <livewire:profile.delete-user-form />
            </div>
            @endif

        </div>
    </div>
</x-app-layout>