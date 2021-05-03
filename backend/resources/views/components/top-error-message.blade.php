@if ($errors->any())
    <div class="py-4 px-4 mb-4 bg-red-400 text-white font-medium rounded-lg">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
