<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Uygulama Paketi Ekle') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 bg-white mt-8 shadow-xl rounded-lg ">
       <x-top-error-message/>
        <form class="w-full space-y-8" action="{{ route('app-packages.store') }}" method="POST">
            @csrf
            <div class="flex items-center">
                <x-app-form-label>{{ __('Paket Adı') }}</x-app-form-label>
                <x-jet-input class="w-full" name="name" type="text" value="{{  old('name') }}"></x-jet-input>
            </div>
            <div class="flex items-center ">
                <x-app-form-label>{{ __('Paket Görsel URL') }}</x-app-form-label>
                <x-jet-input class="w-full" name="image_path" type="text" value="{{ old('image_path') }}"></x-jet-input>
            </div>
            <div class="flex items-top ">
                <x-app-form-label>{{ __('Paketteki Uygulamalar') }}</x-app-form-label>
                <livewire:form.pardus-app-selector :selected="[]"/>
            </div>
            <div class="flex justify-end">
                <x-jet-button>{{ __('Kaydet') }}</x-jet-button>
            </div>
        </form>
    </div>
</x-app-layout>
