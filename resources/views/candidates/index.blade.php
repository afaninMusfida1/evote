<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Candidates List') }}
        </h2>
    </x-slot>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-center mb-6">Candidates List</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 border border-green-400 p-4 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 border border-red-400 p-4 rounded mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($candidates as $candidate)
                <div class="border p-4 rounded-lg shadow-lg flex flex-col items-center">
                    <img src="{{ $candidate->image_url }}" alt="{{ $candidate->name }}" class="w-32 h-32 object-cover rounded-full mb-4">
                    <h3 class="text-lg font-semibold">{{ $candidate->name }}</h3>
                    <p class="text-gray-600 mb-2">Nomor Urut: {{ $candidate->nomor_urut }}</p>
                    <p class="text-gray-500 text-sm mb-4">{{ $candidate->visi_misi }}</p>

                    <!-- Tambahkan Tombol Edit -->
                    <a href="{{ route('candidates.edit', $candidate->id) }}" 
                        class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                        Edit
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
