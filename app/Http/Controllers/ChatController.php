<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Payment;
use App\Models\Course;
use App\Models\User;

class ChatController extends Controller
{
    public function chatMentor($courseId, $chatId = null)
    {
        $user = auth()->user();
    
        // Ambil semua chat berdasarkan mentor dan courseId
        $chats = Chat::where('mentor_id', $user->id)
            ->where('course_id', $courseId)
            ->get();
    
        // Ambil daftar student yang telah membeli kursus dengan status pembayaran success
        $students = Payment::where('transaction_status', 'success')
            ->whereHas('course', function ($query) use ($user, $courseId) {
                $query->where('mentor_id', $user->id)
                      ->where('id', $courseId);
            })
            ->with('user')
            ->get()
            ->pluck('user')
            ->unique();
    
        // Tetapkan chat aktif jika ada chat ID yang diberikan
        $activeChat = $chatId ? Chat::where('id', $chatId)
            ->where('mentor_id', $user->id)
            ->where('course_id', $courseId)
            ->first() : $chats->first();
    
        // Ambil pesan-pesan jika ada chat aktif
        $messages = $activeChat ? $activeChat->messages()->with('sender')->get() : [];
    
        return view('dashboard-mentor.chat', compact('chats', 'messages', 'activeChat', 'students'));
    }

    public function chatStudent($courseId, $chatId = null)
    {
        $user = auth()->user();
    
        // Ambil kursus yang terhubung dengan student (menggunakan payment untuk memastikan sudah membeli kursus)
        $course = Payment::where('user_id', $user->id)
                         ->where('transaction_status', 'success')
                         ->where('course_id', $courseId)  // Pastikan menambahkan filter berdasarkan courseId
                         ->first()?->course;  // Mengambil course yang terkait
    
        // Jika tidak ada kursus yang dibeli, arahkan ke halaman yang sesuai
        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'You have not enrolled in this course.');
        }
    
        // Ambil mentor dari kursus yang sudah dibeli
        $mentorId = $course->mentor_id;
    
        // Ambil semua chat yang melibatkan student dan mentor tersebut
        $chats = Chat::where('student_id', $user->id)
                     ->where('mentor_id', $mentorId)
                     ->with('mentor')
                     ->get();
    
        // Tentukan chat aktif
        $activeChat = $chatId ? Chat::find($chatId) : $chats->first();
    
        // Pastikan jika tidak ada chat yang ditemukan, aktifkan chat baru
        if (!$activeChat) {
            return redirect()->route('chat.start', $user->id)->with('error', 'No chat found. Please start a new chat.');
        }
    
        // Ambil pesan-pesan dari chat aktif
        $messages = $activeChat ? Message::where('chat_id', $activeChat->id)->with('sender')->get() : [];
    
        // Passing course ke view
        return view('dashboard-peserta.chat', compact('chats', 'messages', 'activeChat', 'mentorId', 'course'));
    }    
    
    public function sendMessage(Request $request, $chatId)
    {
        // Validasi input pesan
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);
    
        // Periksa apakah chat dengan ID yang diberikan ada
        $chat = Chat::findOrFail($chatId);
    
        // Validasi apakah user saat ini adalah bagian dari chat
        if (auth()->id() !== $chat->mentor_id && auth()->id() !== $chat->student_id) {
            abort(403, 'Unauthorized action.');
        }
    
        // Simpan pesan baru
        $chat->messages()->create([
            'sender_id' => auth()->id(),
            'message' => $request->message,
        ]);
    
        // Tentukan route berdasarkan peran pengguna
        $roleRoute = auth()->user()->role == 'mentor' ? 'chat.mentor' : 'chat.student';
    
        // Redirect dengan menambahkan parameter courseId
        return redirect()->route($roleRoute, [
            'courseId' => $chat->course_id, // Tambahkan courseId
            'chatId' => $chat->id,         // Chat yang sedang aktif
        ])->with('success', 'Message sent successfully.');
    }
    

    public function startChat(Request $request, $studentId)
    {
        $mentorId = auth()->id();
        
        // Ambil kursus mentor untuk mengaitkan dengan chat
        $course = Course::where('mentor_id', $mentorId)->firstOrFail();
        
        $chat = Chat::firstOrCreate([
            'mentor_id' => $mentorId,
            'student_id' => $studentId,
            'course_id' => $course->id,
        ]);
    
        return redirect()->route('chat.mentor', ['courseId' => $course->id, 'chatId' => $chat->id]);
    }
    
}
