<div class="flex space-x-12 w-full">
    <div class="border border-gray-100 flex-1 px-8 py-4 rounded-md shadow-md">
        <div class="mb-4 font-bold text-center">{{ __("İlişkilendirilebilir Pardus Uygulamaları") }}</div>
        <x-jet-input type="text" wire:model="searchWord" class="mb-4 w-full" placeholder="Ara..."/>
        <div class="border-gray-200 border-t pt-4">
            <div class="h-36 overflow-y-auto px-4">
                @foreach($filteredPardusApps as $pardusApp)
                    @if(!in_array($pardusApp->id, $selected))
                        <button type="button" class="block"
                                wire:click="select({{ $pardusApp->id }})">{{ $pardusApp->name }}</button>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="border border-gray-100 flex-1  px-8 py-4 rounded-md shadow-md">
        <div class="mb-4 font-bold text-center">{{ __("İlişkilendirilen Pardus Uygulamaları") }}</div>
        <div class="border-gray-200 border-t pt-4">
            <div class="h-48 overflow-y-auto px-4">
                @foreach($pardusApps as $pardusApp)
                    @if(in_array($pardusApp->id, $selected))
                        <button type="button" class="block"
                                wire:click="deselect({{ $pardusApp->id }})">
                            {{ $pardusApp->name }}
                        </button>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @foreach($pardusApps as $pardusApp)
        @if(in_array($pardusApp->id, $selected))
            <input type="hidden" name="pardus_apps[]" value="{{ $pardusApp->id }}"/>
        @endif
    @endforeach
</div>
