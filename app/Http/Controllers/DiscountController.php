<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Course;
use App\Models\Keranjang;
use Carbon\Carbon;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all(); // Ambil semua data diskon
    
        return view('dashboard-admin.discount', compact('discounts'));
    }

    public function create()
    {
        $courses = Course::all(); // Ambil semua data kursus
    
        return view('dashboard-admin.discount-tambah', compact('courses'));
    }    
    
    public function applyDiscount(Request $request)
    {
        $couponCode = $request->coupon_code;
        $courseId = $request->course_id;

        // Cari diskon berdasarkan kode kupon
        $discount = Discount::where('coupon_code', $couponCode)->first();

        // Jika kupon tidak ditemukan
        if (!$discount) {
            return response()->json(['message' => 'Kupon tidak valid'], 400);
        }

        // Cek apakah kupon masih dalam periode yang berlaku
        $now = Carbon::now();
        $startDateTime = Carbon::parse($discount->start_date . ' ' . $discount->start_time);
        $endDateTime = Carbon::parse($discount->end_date . ' ' . $discount->end_time);

        if ($now->lt($startDateTime) || $now->gt($endDateTime)) {
            return response()->json(['message' => 'Kupon sudah kadaluarsa atau belum aktif'], 400);
        }

        // Ambil kursus berdasarkan ID
        $course = Course::find($courseId);
        
        if (!$course) {
            return response()->json(['message' => 'Kursus tidak ditemukan'], 400);
        }

        // Cek apakah kupon berlaku untuk semua kursus atau hanya kursus tertentu
        if (!$discount->apply_to_all && !$discount->courses->contains($courseId)) {
            return response()->json(['message' => 'Kupon tidak berlaku untuk kursus ini'], 400);
        }

        // Hitung harga setelah diskon
        $discountAmount = ($course->price * $discount->discount_percentage) / 100;
        $discountedPrice = max($course->price - $discountAmount, 0); // Pastikan harga tidak negatif

        return response()->json([
            'original_price' => $course->price,
            'discount_percentage' => $discount->discount_percentage,
            'discounted_price' => $discountedPrice,
            'message' => 'Diskon berhasil diterapkan'
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'coupon_code' => 'required|unique:discounts,coupon_code',
            'discount_percentage' => 'required|integer|min:1|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required',
            'end_time' => 'required',
            'apply_to_all' => 'nullable|boolean',
            'courses' => 'nullable|array',
        ]);
    
        $applyToAll = $request->has('apply_to_all');
    
        $discount = Discount::create([
            'coupon_code' => $request->coupon_code,
            'discount_percentage' => $request->discount_percentage,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'apply_to_all' => $applyToAll
        ]);
    
        if (!$applyToAll && $request->has('courses')) {
            $discount->courses()->attach($request->courses);
        }
    
        return redirect()->route('discount')->with('success', 'Diskon berhasil dibuat!');
    }
    
}
