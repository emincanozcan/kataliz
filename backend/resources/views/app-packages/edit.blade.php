<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Uygulama Paketi Düzenle') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 bg-white mt-8 shadow-xl rounded-lg ">
        <x-top-error-message/>
        <h1 class="text-3xl font-medium mb-8">{{ $appPackage->name }}</h1>
        <form class="w-full space-y-8" action="{{ route('app-packages.update', $appPackage->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="flex items-center">
                <x-app-form-label>{{ __('Paket Adı') }}</x-app-form-label>
                <x-jet-input class="w-full" name="name" type="text" value="{{ $appPackage->name }}"></x-jet-input>
            </div>
            <div class="flex items-center ">
                <x-app-form-label>{{ __('Paket Görsel URL') }}</x-app-form-label>
                <x-jet-input class="w-full" name="image_path" type="text"
                             value="{{ $appPackage->image_path }}"></x-jet-input>
            </div>
            <div class="flex items-top ">
                <x-app-form-label>{{ __('Paketteki Uygulamalar') }}</x-app-form-label>
                <livewire:form.pardus-app-selector :selected="$appPackage->pardusApps()->pluck('id')->toArray()"/>
            </div>
            <div class="flex justify-end">
                <x-jet-button>{{ __('Kaydet') }}</x-jet-button>
            </div>
        </form>
    </div>
</x-app-layout>
