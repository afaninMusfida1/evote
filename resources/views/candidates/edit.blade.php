<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Candidate') }}
        </h2>
    </x-slot>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <form action="{{ route('candidates.update', $candidate->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Field Nama -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name:</label>
                <input type="text" name="name" id="name" value="{{ $candidate->name }}" class="w-full border-gray-300 rounded-lg">
            </div>

            <!-- Field Nomor Urut -->
            <div class="mb-4">
                <label for="nomor_urut" class="block text-gray-700">Nomor Urut:</label>
                <input type="text" name="nomor_urut" id="nomor_urut" value="{{ $candidate->nomor_urut }}" class="w-full border-gray-300 rounded-lg">
            </div>

            <!-- Field Visi Misi -->
            <div class="mb-4">
                <label for="visi_misi" class="block text-gray-700">Visi & Misi:</label>
                <textarea name="visi_misi" id="visi_misi" class="w-full border-gray-300 rounded-lg">{{ $candidate->visi_misi }}</textarea>
            </div>

            <!-- Field Upload Gambar -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700">Upload New Image:</label>
                <input type="file" name="image" id="image" class="w-full border-gray-300 rounded-lg">
            </div>

            <!-- Tampilkan Gambar Saat Ini -->
            @if ($candidate->image_url)
                <div class="mb-4">
                    <p>Current Image:</p>
                    <img src="{{ $candidate->image_url }}" alt="{{ $candidate->name }}" class="w-32 h-32 object-cover rounded-full mb-4">
                </div>
            @endif

            <!-- Tombol Submit -->
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update</button>
        </form>
    </div>
</x-app-layout>
