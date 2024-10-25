@extends('layouts.dashboard-admin')
@section('content')
<div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Data User</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full border-separate border-spacing-1">
            <thead>
                <tr class="bg-sky-200">
                    <th class="border border-gray-300 px-4 py-2 rounded-md">ID</th>
                    <th class="border border-gray-300 px-4 py-2 rounded-md">Nama</th>
                    <th class="border border-gray-300 px-4 py-2 rounded-md">Email</th>
                    <th class="border border-gray-300 px-4 py-2 rounded-md">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="bg-white hover:bg-sky-50">
                        <td class="border border-gray-300 px-4 py-2 rounded-md text-center">{{ $user->id }}</td>
                        <td class="border border-gray-300 px-4 py-2 rounded-md">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2 rounded-md">{{ $user->email }}</td>
                        <td class="py-3 px-6 text-left border border-gray-300 rounded-md">
                            <a href="#" class="text-blue-600 hover:text-blue-800">Edit</a>
                            <a href="#" class="text-red-600 hover:text-red-800 ml-4">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>








@endsection