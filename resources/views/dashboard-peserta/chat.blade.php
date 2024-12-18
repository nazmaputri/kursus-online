@extends('layouts.dashboard-peserta')

@section('content')
<div class="inline-block h-[450px] flex">
    <!-- Main Chat Area -->
    <main class="flex-1 flex flex-col">
        @if ($activeChat)
            <!-- Header Chat -->
            <div class="bg-white border-b border-gray-300 p-4 flex items-center relative">
                <div class="flex items-center">
                    <!-- Foto Avatar Mentor -->
                    @if($activeChat->mentor->photo)
                        <!-- Jika mentor memiliki foto profil -->
                        <img 
                            src="{{ asset('storage/' . $activeChat->mentor->photo) }}" 
                            class="w-10 h-10 rounded-full" 
                            alt="{{ $activeChat->mentor->name }} Avatar">
                    @else
                        <!-- Jika mentor tidak memiliki foto profil -->
                        <svg class="w-10 h-10 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M399 384.2C376.9 345.8 335.4 320 288 320l-64 0c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"/>
                        </svg>
                    @endif
                    <!-- Informasi Mentor -->
                    <div class="ml-4">
                        <h3 class="text-gray-700 font-medium">{{ $activeChat->mentor->name }}</h3>
                        <p class="text-gray-500 text-sm">
                            {{ $activeChat->mentor->is_online ? 'Online' : 'Offline' }}
                        </p>
                    </div>
                </div>                
                <!-- Tombol Kembali di samping kanan header -->
                <a href="{{ route('daftar-kursus') }}" class="bg-sky-300 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded absolute right-4 top-1/2 transform -translate-y-1/2">
                    Kembali
                </a>        
            </div>            

            <!-- Pesan Chat -->
            <div class="flex-1 overflow-y-auto p-4 bg-neutral-50 scrollbar-hidden">
                @foreach ($messages as $message)
                    <div class="flex items-start mb-4 @if($message->sender_id == auth()->id()) justify-end @else justify-start @endif">
                        <!-- Pesan Mentor (Gray) -->
                        @if($message->sender_id == auth()->id())
                            <div class="bg-blue-500 text-white p-3 rounded-lg shadow-md">
                                <p>{{ $message->message }}</p>
                                <p class="text-xs text-gray-300 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                            </div>
                        <!-- Pesan Student (Blue) -->
                        @else
                            <div class="border text-gray-600 p-3 rounded-lg shadow-md">
                                <p>{{ $message->message }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Input Pesan -->
            <div class="p-4 bg-white border-t border-gray-300">
                <form action="{{ route('chat.send', $activeChat->id) }}" method="POST" class="flex items-center">
                    @csrf
                    <!-- Menambahkan hidden input untuk course_id -->
                    <input type="hidden" name="course_id" value="{{ $activeChat->course_id }}"> <!-- Menambahkan course_id -->
                    <input type="text" name="message" placeholder="Type a message..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
                    <button type="submit" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Send
                    </button>
                </form>
            </div>
        @else
            <div class="flex-1 flex items-center justify-center p-4 bg-gray-50">
                <p class="text-gray-500">No active chat found. Please start a new chat.</p>
            </div>
        @endif
    </main>
</div>
@endsection
