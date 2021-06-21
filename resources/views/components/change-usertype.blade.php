<x-jet-action-section>
    <x-slot name="title">
        {{ __('User Controls') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Modify other users ') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('') }}
        </div>

        <div class="mt-5">
        <form   method="GET" action="{{ route('displayusers') }}">
            <x-jet-danger-button  wire:loading.attr="disabled">
                {{ __('monitor users') }}
             
            </x-jet-danger-button>
            <form>
        </div>

        </x-slot>

        </x-jet-action-section>