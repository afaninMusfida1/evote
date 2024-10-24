<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Candidate') }}
        </h2>
    </x-slot>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-center mb-6">Add New Candidate</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 border border-red-400 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('candidates.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Candidate Name:</label>
                <input type="text" id="name" name="name" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
            </div>

            <div>
                <label for="nomor_urut" class="block text-sm font-medium text-gray-700">Nomor Urut:</label>
                <input type="number" id="nomor_urut" name="nomor_urut" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Candidate Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
            </div>

            <div>
                <label for="visi_misi" class="block text-sm font-medium text-gray-700">Visi Misi:</label>
                <textarea id="visi_misi" name="visi_misi" rows="4" required class="mt-1 block w-full p-2 border border-gray-300 rounded"></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition duration-300">Add Candidate</button>
        </form>
    </div>
</x-app-layout>
