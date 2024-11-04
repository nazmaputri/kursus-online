@extends('layouts.dashboard-admin')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-3xl font-bold mb-8 inline-block border-b-2 border-gray-300 pb-2">Data Mentor</h2>

        <!-- Tabel data user -->
        <div class="overflow-x-auto">
            <table class="min-w-full border-separate border-spacing-1" id="userTable">
                <thead>
                    <tr class="bg-sky-200">
                        <th class="border border-gray-300 px-4 py-2 rounded-md">No</th>
                        <th class="border border-gray-300 px-4 py-2 rounded-md">Nama</th>
                        <th class="border border-gray-300 px-4 py-2 rounded-md">Status</th>
                        <th class="border border-gray-300 px-4 py-2 rounded-md">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr class="bg-white hover:bg-sky-50 user-row" data-role="{{ $user->role }}">
                            <td class="border border-gray-300 px-4 py-2 rounded-md text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2 rounded-md">{{ $user->name }}</td>
                            <td class="py-3 px-4 text-center border border-gray-300 rounded-md">
                                <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if($user->status === 'pending')
                                        <button type="submit" class="text-green-500 hover:text-green-700">Set Active</button>
                                    @else
                                        <span class="text-gray-500">Active</span>
                                    @endif
                                </form>
                            </td>                                             
                            <td class="py-3 px-6 text-center border border-gray-300 rounded-md">
                                <div class="flex items-center justify-center space-x-8">
                                    <!-- Tombol Lihat Detail -->
                                    <a href="{{ route('detaildata-mentor', ['id' => $user->id]) }}" class="text-gray-500 hover:text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>
                                    <!-- Form hapus kategori -->
                                    <form id="deleteForm" action="" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="text-red-500 hover:text-red-700" onclick="openDeleteModal()">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>                                                                        
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('info'))
    <div class="bg-yellow-200 text-yellow-800 p-2 rounded mb-4">
        {{ session('info') }}
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.tab-button');
        const userRows = document.querySelectorAll('.user-row');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                const role = button.id;

                // Update button styles
                buttons.forEach(btn => {
                    btn.classList.remove('bg-sky-200', 'text-gray-800');
                    btn.classList.add('bg-gray-100', 'text-gray-600');
                });
                button.classList.add('bg-sky-200', 'text-gray-800');

                // Show/Hide rows based on role
                userRows.forEach(row => {
                    if (role === 'allUsers' || row.dataset.role.toLowerCase() === role) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    });
</script>

@endsection
