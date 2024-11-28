@extends('layouts.dashboard-mentor')

@section('content')
<div class="h-screen flex">
    <!-- Sidebar untuk daftar user atau mentor -->
    <aside class="w-1/3 bg-white border-r border-gray-300">
        <div class="p-4">
            <h2 class="text-xl font-semibold mb-4">Chats</h2>
            <div class="space-y-4">
                <!-- List Chat -->
                @foreach ($chats as $chat)
                    <a href="{{ route('chat.' . (auth()->user()->role == 'mentor' ? 'mentor' : 'student'), $chat->id) }}" class="flex items-center p-3 bg-gray-100 rounded-lg cursor-pointer hover:bg-gray-200">
                        <img src="https://via.placeholder.com/40" class="w-10 h-10 rounded-full" alt="User Avatar">
                        <div class="ml-4">
                            <h3 class="text-gray-700 font-medium">
                                @if ($chat->mentor_id)
                                    {{ $chat->mentor->name }}
                                @else
                                    {{ $chat->student->name }}
                                @endif
                            </h3>
                            <p class="text-gray-500 text-sm truncate">Last message...</p>
                        </div>
                    </a>
                @endforeach

                <!-- Start New Chat Button -->
                @if (auth()->user()->role == 'mentor')
                    <p class="text-gray-500 mt-4">Start a new chat:</p>
                    @foreach ($students as $student)
                        <a href="{{ route('chat.' . (auth()->user()->role == 'mentor' ? 'mentor' : 'student'), ['chatId' => $student->id]) }}" class="flex items-center p-3 bg-gray-100 rounded-lg cursor-pointer hover:bg-gray-200">
                            <img src="https://via.placeholder.com/40" class="w-10 h-10 rounded-full" alt="User Avatar">
                            <div class="ml-4">
                                <h3 class="text-gray-700 font-medium">{{ $student->name }}</h3>
                                <p class="text-gray-500 text-sm">Start new chat</p>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </aside>

    <!-- Main Chat Area -->
    <main class="flex-1 flex flex-col">
        @if ($activeChat)
            <!-- Header -->
            <div class="bg-white border-b border-gray-300 p-4 flex items-center">
                <img src="https://via.placeholder.com/40" class="w-10 h-10 rounded-full" alt="User Avatar">
                <div class="ml-4">
                    <h3 class="text-gray-700 font-medium">{{ $activeChat->mentor->name ?? $activeChat->student->name }}</h3>
                    <p class="text-gray-500 text-sm">Online</p>
                </div>
            </div>

            <!-- Chat Messages -->
            <div class="flex-1 overflow-y-auto p-4 bg-gray-50">
                @foreach ($messages as $message)
                    <div class="flex items-start mb-4 @if($message->sender_id == auth()->id()) justify-end @else justify-start @endif">
                        <div class="bg-blue-500 text-white p-3 rounded-lg shadow-md">
                            <p>{{ $message->message }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Chat Input -->
            <div class="p-4 bg-white border-t border-gray-300">
                <form action="{{ route('chat.send', $activeChat->id) }}" method="POST" class="flex items-center">
                    @csrf
                    <input type="text" name="message" placeholder="Type a message..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
                    <button type="submit" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Send</button>
                </form>
            </div>
        @else
            <div class="flex-1 flex items-center justify-center p-4 bg-gray-50">
                <p class="text-gray-500">Select a user to start chatting.</p>
            </div>
        @endif
    </main>
</div>
@endsection
