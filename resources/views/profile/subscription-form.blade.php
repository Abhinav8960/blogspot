@php
use App\Models\Post;
use Illuminate\Support\Str;

$approvedBlogs = Post::where('status', 1)
->where('user_id', auth()->id())
->orderBy('created_at', 'desc')
->get();

$plans = [
['id' => 'basic', 'name' => 'Basic', 'price' => 'Free'],
['id' => 'premium', 'name' => 'Premium', 'price' => '₹499'],
['id' => 'enterprise', 'name' => 'Enterprise', 'price' => '₹999'],
];
@endphp

<form action="{{ route('profile.subscription.store') }}" method="POST">
    @csrf

    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 py-5 sm:px-6">
                <h3 style="color: #1f1f1f; font-size: 1.5rem; font-weight: 600;">{{ __('Subscription Setup') }}</h3>
                <p style="color: #666666; font-size: 0.875rem; margin-top: 0.5rem;">{{ __('Select your approved blogs and choose a subscription plan.') }}</p>
            </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="p-6 bg-white shadow sm:rounded-md">
                @if(session('subscription_success'))
                <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                    {{ session('subscription_success') }}
                </div>
                @endif

                <!-- Blog Selection Section -->
                <div class="mb-6" x-data="{ selected: {{ json_encode(old('post_ids', [])) }} }">
                    <div class="mb-4 flex items-center justify-between">
                        <label class="block text-sm font-semibold text-gray-900">{{ __('Select Blogs') }}</label>
                        <span class="text-sm font-medium text-indigo-600">Selected: <span x-text="selected.length"></span></span>
                    </div>

                    @error('post_ids')
                    <p class="mb-3 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div class="grid grid-cols-6 gap-3">
                        @forelse($approvedBlogs as $post)
                        <label class="group relative cursor-pointer overflow-hidden rounded-lg border-2 transition"
                            :class="selected.includes('{{ $post->id }}') ? 'border-indigo-500 bg-indigo-50' : 'border-gray-200 bg-white hover:border-gray-300'">
                            <input type="checkbox" name="post_ids[]" value="{{ $post->id }}" class="sr-only" x-model="selected">

                            <div class="relative w-full overflow-hidden bg-gray-100" style="height: 60px;">
                                @if($post->image)
                                <img src="{{ $post->image }}"
                                    alt="{{ $post->title }}"
                                    class="h-full w-full object-cover object-center transition-transform duration-300 group-hover:scale-105" /> @else
                                <div class="flex h-full items-center justify-center bg-gray-200 text-gray-400">
                                    <i class="fa fa-image text-lg"></i>
                                </div>
                                @endif
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>
                            </div>

                            <div class="p-2">
                                <h5 class="truncate text-sm font-semibold text-gray-900">{{ $post->title }}</h5>
                            </div>

                            <!-- Checkbox indicator -->
                            <div class="absolute right-2 top-2 rounded-full bg-white shadow-sm transition"
                                :class="selected.includes('{{ $post->id }}') ? 'bg-indigo-500' : 'bg-gray-200'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    :class="selected.includes('{{ $post->id }}') ? 'text-white' : 'text-gray-400'"
                                    class="h-4 w-4 p-0.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </label>
                        @empty
                        <div class="col-span-full rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 py-8 text-center text-sm text-gray-500">
                            No approved blogs yet. Admin approval is required.
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Plan Selection Section -->
                <div class="mb-6" x-data="{ plan: '{{ old('plan', 'basic') }}' }">
                    <label class="block text-sm font-semibold text-gray-900 mb-4">{{ __('Choose Plan') }}</label>

                    @error('plan')
                    <p class="mb-3 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div class="grid gap-3 sm:grid-cols-3">
                        @foreach($plans as $plan)
                        <label class="block cursor-pointer rounded-lg border-2 p-4 transition"
                            :class="plan === '{{ $plan['id'] }}' ? 'border-indigo-500 bg-indigo-50' : 'border-gray-200 bg-white hover:border-gray-300'">
                            <input type="radio" name="plan" value="{{ $plan['id'] }}" class="sr-only" x-model="plan">
                            <div class="text-sm font-semibold text-gray-900">{{ $plan['name'] }}</div>
                            <div class="mt-2 text-xl font-bold text-indigo-600">{{ $plan['price'] }}</div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full rounded-lg px-6 py-3 text-center font-semibold text-white transition" style="background: linear-gradient(135deg, #89d8fc 0%, #66b2c5 100%);">
                    {{ __('Add Subscription') }}
                </button>
            </div>
        </div>
    </div>
</form>