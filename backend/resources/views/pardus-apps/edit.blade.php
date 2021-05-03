<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pardus Uygulaması Düzenle') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 bg-white mt-8 shadow-xl rounded-lg ">
        <x-top-error-message />
        <h1 class="text-3xl font-medium mb-8">{{ $pardusApp->name }}</h1>
        <form class="w-full space-y-8" action="{{ route('pardus-apps.update', $pardusApp->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="flex items-center">
                <x-jet-label class="w-80 font-medium text-xl">{{ __('Uygulama Adı') }}</x-jet-label>
                <x-jet-input class="w-full" name="name" type="text" value="{{ $pardusApp->name }}"></x-jet-input>
            </div>
            <div class="flex items-center ">
                <x-jet-label class="w-80 font-medium text-xl">{{ __('Uygulama Görsel URL') }}</x-jet-label>
                <x-jet-input class="w-full" name="image_url" type="text" value="{{ $pardusApp->image_url }}"></x-jet-input>
            </div>
            <div class="flex items-start">
                <x-jet-label class="w-80 font-medium text-xl">{{ __('Yükleme Komutları') }}</x-jet-label>
                <livewire:form.scripts-field :scripts="$pardusApp->scripts" />
            </div>
            <div class="flex justify-end">
                <x-jet-button>{{ __('Kaydet') }}</x-jet-button>
            </div>
        </form>
    </div>
</x-app-layout>
