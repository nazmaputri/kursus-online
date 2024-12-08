@extends('layouts.dashboard-peserta')

@section('content')
<div class="h-screen flex">

    <!-- Main Chat Area -->
    <main class="flex-1 flex flex-col">
        @if ($activeChat)
            <!-- Header Chat -->
            <div class="bg-white border-b border-gray-300 p-4 flex items-center">
                <img src="https://via.placeholder.com/40" class="w-10 h-10 rounded-full" alt="Mentor Avatar">
                <div class="ml-4">
                    <h3 class="text-gray-700 font-medium">{{ $activeChat->mentor->name }}</h3>
                    <p class="text-gray-500 text-sm">Online</p>
                </div>
            </div>

            <!-- Pesan Chat -->
            <div class="flex-1 overflow-y-auto p-4 bg-neutral-50">
                @foreach ($messages as $message)
                    <div class="flex items-start mb-4 @if($message->sender_id == auth()->id()) justify-end @else justify-start @endif">
                        <!-- Pesan Mentor (Gray) -->
                        @if($message->sender_id == auth()->id())
                            <div class="bg-blue-500 text-white p-3 rounded-lg shadow-md">
                                <p>{{ $message->message }}</p>
                                <!-- Waktu pengiriman pesan -->
                                <p class="text-xs text-gray-300 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                            </div>
                        <!-- Pesan Student (Blue) -->
                        @else
                            <div class="border text-gray-600 p-3 rounded-lg shadow-md">
                                <p>{{ $message->message }}</p>
                                <!-- Waktu pengiriman pesan -->
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
                    <input type="text" name="message" placeholder="Type a message..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
                    <button type="submit" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Send</button>
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
