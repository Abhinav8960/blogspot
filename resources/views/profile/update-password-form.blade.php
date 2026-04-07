<x-form-section submit="updatePassword">
    <x-slot name="title">
        <div style="color: #1f1f1f; font-size: 1.5rem; font-weight: 600;">{{ __('Update Password') }}</div>
    </x-slot>

    <x-slot name="description">
        <div style="color: #666666; font-size: 0.875rem;">{{ __('Ensure your account is using a long, random password to stay secure.') }}</div>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Current Password') }}" style="color: #1f1f1f; font-weight: 500;" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" style="border: 1px solid #ddd; border-radius: 5px; padding: 8px 12px; color: #333;" wire:model="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" style="color: #dc3545;" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('New Password') }}" style="color: #1f1f1f; font-weight: 500;" />
            <x-input id="password" type="password" class="mt-1 block w-full" style="border: 1px solid #ddd; border-radius: 5px; padding: 8px 12px; color: #333;" wire:model="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" style="color: #dc3545;" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" style="color: #1f1f1f; font-weight: 500;" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" style="border: 1px solid #ddd; border-radius: 5px; padding: 8px 12px; color: #333;" wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" style="color: #dc3545;" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved" style="color: #28a745;">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button style="background: linear-gradient(135deg, #89d8fc 0%, #66b2c5 100%); color: white; border: none; padding: 10px 20px; border-radius: 5px; font-weight: 500;">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>