<?php

namespace App\Http\Controllers\DashboardMentor;

use App\Http\Controllers\Controller;
use App\Models\MateriPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function destroy(MateriPdf $pdf)
    {
        // Menghapus file PDF dari storage public
        if (Storage::disk('public')->exists($pdf->pdf_file)) {
            Storage::disk('public')->delete($pdf->pdf_file);
        }
    
        // Menghapus record PDF dari database
        $pdf->delete();
    
        // Mengembalikan respons JSON untuk AJAX
        return response()->json(['success' => true, 'message' => 'PDF berhasil dihapus!']);
    } 
    
}
