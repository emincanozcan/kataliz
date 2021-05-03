<div class="w-full space-y-4">
    @foreach($scripts as $key => $script)
        <div class="flex items-center">
            <x-jet-input class="w-full" name="scripts[]" type="text" value="{{ $script }}"></x-jet-input>
            <x-jet-button type="button" wire:click="remove( {{ $key }} )" class="ml-4 bg-red-400 text-white text-center">X</x-jet-button>
        </div>
    @endforeach
    <div class="flex justify-end">
        <x-jet-button type="button" wire:click="addNew">{{ __("Yeni Satır Ekle") }}</x-jet-button>
    </div>
</div>
