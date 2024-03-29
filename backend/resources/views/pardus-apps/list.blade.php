<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pardus Uygulamalar') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 bg-white mt-8 shadow-xl rounded-lg ">
        <x-top-success-message/>
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-medium mb-8">{{ __('Uygulama Listesi') }}</h1>
            <x-link-button href="{{ route('pardus-apps.create') }}">{{ __('Yeni Oluştur') }}</x-link-button>
        </div>
        <table class="table-fixed w-full rounded-lg shadow-lg overflow-hidden">
            <thead>
            <tr>
                <x-app-table-head> {{ __('Uygulama Görseli') }}</x-app-table-head>
                <x-app-table-head> {{ __('Uygulama Adı') }}</x-app-table-head>
                <x-app-table-head> {{ __('Aksiyonlar') }}</x-app-table-head>
            </tr>
            </thead>
            <tbody>
            @foreach($pardusApps as $pardusApp)
                <tr>
                    <td class="py-4 border-b border-gray-200 px-8">
                        <img src="{{ $pardusApp->image_url }}" class="h-8 w-8" alt="">
                    </td>
                    <td class="py-4 border-b border-gray-200 px-8"> {{ $pardusApp->name }}</td>
                    <td class="py-4 border-b border-gray-200 px-8">
                        <div class="flex items-center space-x-4">
                            <x-link-button href="{{ route('pardus-apps.edit', $pardusApp->id) }}">
                                {{ __('Düzenle') }}
                            </x-link-button>
                            <form method="post" action="{{ route('pardus-apps.destroy', $pardusApp->id)}}">
                                @csrf
                                @method('DELETE')
                                <x-jet-button type="submit">{{ __('Sil') }}</x-jet-button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $pardusApps->links() }}
        </div>
    </div>
</x-app-layout>
