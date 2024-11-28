<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
    public function chatMentor($chatId = null)
    {
        $user = auth()->user();

        // Ambil semua chat yang berhubungan dengan user
        $chats = Chat::where('student_id', $user->id)
                    ->orWhere('mentor_id', $user->id)
                    ->get();

        // Ambil daftar user dengan role 'student' atau 'mentor' untuk memulai chat baru
        $students = User::where('role', 'student')->get();
        $mentors = User::where('role', 'mentor')->get();

        // Tentukan chat aktif jika ada chat ID yang diberikan
        $activeChat = $chatId ? Chat::find($chatId) : $chats->first();

        // Jika chat aktif ditemukan, ambil pesan-pesannya
        $messages = $activeChat ? Message::where('chat_id', $activeChat->id)->get() : [];

        return view('dashboard-mentor.chat', compact('chats', 'messages', 'activeChat', 'students', 'mentors'));
    }

    public function chatStudent($chatId = null)
    {
        $user = auth()->user();

        // Ambil semua chat yang berhubungan dengan user
        $chats = Chat::where('student_id', $user->id)
                    ->orWhere('mentor_id', $user->id)
                    ->get();

        // Ambil daftar user dengan role 'mentor' untuk memulai chat baru
        $mentors = User::where('role', 'mentor')->get();
        $students = User::where('role', 'student')->get();

        // Tentukan chat aktif jika ada chat ID yang diberikan
        $activeChat = $chatId ? Chat::find($chatId) : $chats->first();

        // Jika chat aktif ditemukan, ambil pesan-pesannya
        $messages = $activeChat ? Message::where('chat_id', $activeChat->id)->get() : [];

        return view('dashboard-peserta.chat', compact('chats', 'messages', 'activeChat', 'students', 'mentors'));
    }

    // Method untuk mengirim pesan
    public function sendMessage(Request $request, $chatId)
    {
        // Validasi input pesan
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);
    
        // Periksa apakah chat dengan ID yang diberikan ada
        $chat = Chat::findOrFail($chatId);
        
        // Simpan pesan baru
        $message = new Message([
            'chat_id' => $chatId,
            'sender_id' => auth()->id(),  // Menyimpan id pengirim dari auth
            'message' => $request->message,
        ]);
        
        $message->save();
    
        // Redirect kembali ke halaman chat yang sama setelah pesan terkirim
        if (auth()->user()->role == 'mentor') {
            return redirect()->route('chat.mentor', $chatId);
        } else {
            return redirect()->route('chat.student', $chatId);
        }
    }
    
}
