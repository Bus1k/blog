@if(session()->has('success'))
    <div x-data="{ show: true}"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
         class="fixed bg-blue-500 text-white py-4 px-4 rounded-full top-4 left-4"
    >
        <p>{{ session('success') }}</p>
    </div>
@endif
