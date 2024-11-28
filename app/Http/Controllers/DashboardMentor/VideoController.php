<?php

namespace App\Http\Controllers\DashboardMentor;

use App\Http\Controllers\Controller;
use App\Models\MateriVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function destroy(MateriVideo $video)
    {
        // Menghapus file video dari storage public
        if (Storage::disk('public')->exists($video->video_url)) {
            Storage::disk('public')->delete($video->video_url);
        }
    
        // Menghapus record Video dari database
        $video->delete();
    
        // Mengembalikan respons JSON untuk AJAX
        return response()->json(['success' => true, 'message' => 'Video berhasil dihapus!']);
    }    

}
