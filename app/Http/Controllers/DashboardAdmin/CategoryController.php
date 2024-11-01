<?php

namespace App\Http\Controllers\DashboardAdmin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $categories = Category::all(); // Mengambil semua kategori
        return view('dashboard-admin.kategori', compact('categories')); // Ganti dengan path view yang sesuai
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('dashboard-admin.tambah-kategori'); // Ganti dengan path view untuk form tambah kategori
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'nullable|string',
        ]);
    
        // Inisialisasi data kategori
        $data = $request->only(['name', 'description']);
    
        // Cek apakah ada gambar yang di-upload
        if ($request->hasFile('image')) {
            // Simpan gambar ke storage dan ambil path-nya
            $data['image_path'] = $request->file('image')->store('images/kategori', 'public'); // Simpan di storage/app/public/images/kategori
        }
    
        // Buat kategori baru dengan data yang telah diolah
        Category::create($data);
    
        return redirect()->route('kategori-admin')->with('success', 'Kategori berhasil ditambahkan!');
    }
    

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard-admin.edit-kategori', compact('category'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'nullable|string',
        ]);
    
        $category = Category::findOrFail($id);
    
        // Update data kategori
        $category->name = $request->input('name');
        $category->description = $request->input('description');
    
        // Cek apakah ada gambar yang di-upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($category->image_path) {
                Storage::disk('public')->delete($category->image_path);
            }
            // Simpan gambar baru dan ambil path-nya
            $category->image_path = $request->file('image')->store('images/kategori', 'public');
        }
    
        $category->save(); // Simpan perubahan ke database
    
        return redirect()->route('kategori-admin')->with('success', 'Kategori berhasil diperbarui!');
    }
    
    // // Menghapus kategori
    // public function destroy($id)
    // {
    //     $category = Category::findOrFail($id);
    //     $category->delete();

    //     return redirect()->route('kategori-index')->with('success', 'Kategori berhasil dihapus!');
    // }
}
