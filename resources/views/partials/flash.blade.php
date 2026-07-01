@if (session('success') || session('error'))
    <div class="container mx-auto px-4 mt-4">
        <div class="{{ session('success') ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-red-50 text-red-700 border-red-200' }} border px-4 py-3 rounded-xl text-sm font-semibold">
            {{ session('success') ?? session('error') }}
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="container mx-auto px-4 mt-4">
        <div class="bg-red-50 text-red-700 border border-red-200 px-4 py-3 rounded-xl text-sm">{{ $errors->first() }}</div>
    </div>
@endif
