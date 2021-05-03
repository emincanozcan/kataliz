<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pardus Dışı Uygulama Düzenle') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 bg-white mt-8 shadow-xl rounded-lg ">
        <x-top-error-message/>
        <h1 class="text-3xl font-medium mb-8">{{ $nonPardusApp->name }}</h1>
        <form class="w-full space-y-8" action="{{ route('non-pardus-apps.update', $nonPardusApp->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="flex items-center">
                <x-app-form-label>{{ __('Uygulama Adı') }}</x-app-form-label>
                <x-jet-input class="w-full" name="name" type="text" value="{{ $nonPardusApp->name }}"></x-jet-input>
            </div>
            <div class="flex items-center">
                <x-app-form-label>{{ __('Uygulama Görsel URL') }}</x-app-form-label>
                <x-jet-input class="w-full" name="image_url" type="text"
                             value="{{ $nonPardusApp->image_url }}"></x-jet-input>
            </div>
            <div class="flex items-top">
                <x-app-form-label>{{ __('Pardus Alternatifleri') }}</x-app-form-label>
                <livewire:form.pardus-app-selector :selected="$nonPardusApp->pardusApps->pluck('id')->toArray()"/>
            </div>
            <div class="flex justify-end">
                <x-jet-button>{{ __('Kaydet') }}</x-jet-button>
            </div>
        </form>
    </div>
</x-app-layout>
