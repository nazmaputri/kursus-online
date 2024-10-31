@extends('layouts.chat-peserta')
@section('content')
<div class="h-screen flex">
    <!-- Sidebar untuk daftar user atau mentor -->
    <aside class="w-1/3 bg-white border-r border-gray-300">
      <div class="p-4">
        <h2 class="text-xl font-semibold mb-4">Chats</h2>
        <div class="space-y-4">
          <!-- List Chat -->
          <div class="flex items-center p-3 bg-gray-100 rounded-lg cursor-pointer hover:bg-gray-200">
            <img src="https://via.placeholder.com/40" class="w-10 h-10 rounded-full" alt="User Avatar">
            <div class="ml-4">
              <h3 class="text-gray-700 font-medium">Mentor 1</h3>
              <p class="text-gray-500 text-sm truncate">Last message...</p>
            </div>
          </div>
          <div class="flex items-center p-3 bg-gray-100 rounded-lg cursor-pointer hover:bg-gray-200">
            <img src="https://via.placeholder.com/40" class="w-10 h-10 rounded-full" alt="User Avatar">
            <div class="ml-4">
              <h3 class="text-gray-700 font-medium">Mentor 2</h3>
              <p class="text-gray-500 text-sm truncate">Last message...</p>
            </div>
          </div>
          <!-- Tambahkan lebih banyak chat di sini -->
        </div>
      </div>
    </aside>

    <!-- Main Chat Area -->
    <main class="flex-1 flex flex-col">
      <!-- Header -->
      <div class="bg-white border-b border-gray-300 p-4 flex items-center">
        <img src="https://via.placeholder.com/40" class="w-10 h-10 rounded-full" alt="Mentor Avatar">
        <div class="ml-4">
          <h3 class="text-gray-700 font-medium">Mentor Name</h3>
          <p class="text-gray-500 text-sm">Online</p>
        </div>
      </div>

      <!-- Chat Messages -->
      <div class="flex-1 overflow-y-auto p-4 bg-gray-50">
        <!-- Message from Mentor -->
        <div class="flex items-start mb-4">
          <img src="https://via.placeholder.com/40" class="w-8 h-8 rounded-full mr-4" alt="Mentor Avatar">
          <div class="bg-white p-3 rounded-lg shadow-md">
            <p class="text-gray-700">Hello, how can I help you today?</p>
          </div>
        </div>
        <!-- Message from User -->
        <div class="flex items-start mb-4 justify-end">
          <div class="bg-blue-500 text-white p-3 rounded-lg shadow-md">
            <p>Hi, I need help with my project.</p>
          </div>
        </div>
      </div>

      <!-- Chat Input -->
      <div class="p-4 bg-white border-t border-gray-300">
        <div class="flex items-center">
          <input type="text" placeholder="Type a message..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
          <button class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Send</button>
        </div>
      </div>
    </main>
  </div>

@endsection