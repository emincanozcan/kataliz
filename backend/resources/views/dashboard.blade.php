<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Yönetim Paneli') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-8 py-8">
                    <h2 class="font-semibold text-2xl leading-tight mb-8 pb-2 border-b border-gray-200">
                        Pardus Kataliz Yönetim Paneli
                    </h2>
                    <p class="font-semibold text-lg mb-4">Hoşgeldin {{ auth()->user()->name }},</p>
                    <p>Kataliz yönetim paneli aracılığıyla, kataliz masaüstü ve web uygulamalarının veri yönetimini
                        gerçekleştirebilirsin.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
