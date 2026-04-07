<x-action-section>
    <x-slot name="title">
        <div style="color: #dc3545; font-size: 1.5rem; font-weight: 600;">{{ __('Delete Account') }}</div>
    </x-slot>

    <x-slot name="description">
        <div style="color: #666666; font-size: 0.875rem;">{{ __('Permanently delete your account.') }}</div>
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm" style="color: #666666;">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled" style="background: #dc3545; color: white; border: none; padding: 10px 20px; border-radius: 5px; font-weight: 500;">
                {{ __('Delete Account') }}
            </x-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Delete Account') }}
            </x-slot>

            <x-slot name="content">
                <div style="color: #666666;">{{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}</div>

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4" style="border: 1px solid #ddd; border-radius: 5px; padding: 8px 12px; color: #333;"
                        autocomplete="current-password"
                        placeholder="{{ __('Password') }}"
                        x-ref="password"
                        wire:model="password"
                        wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" style="color: #dc3545;" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled" style="background: #e0e0e0; color: #333; border: none; padding: 10px 20px; border-radius: 5px; font-weight: 500;">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteUser" wire:loading.attr="disabled" style="background: #dc3545; color: white; border: none; padding: 10px 20px; border-radius: 5px; font-weight: 500;">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>