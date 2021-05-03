@if (session()->has('success'))
    <div class="text-xl text-center rounded-lg text-white bg-green-500 mb-6 py-4 text-medium">
        {{ session('success') }}
    </div>
@endif
