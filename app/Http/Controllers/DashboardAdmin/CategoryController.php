<?php

namespace App\Http\Controllers\DashboardAdmin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5);
        $courses = Course::paginate(10);
        return view('dashboard-admin.category', compact('categories', 'courses'));
    }

    public function show($name)
    {
        $category = Category::with('courses')->where('name', $name)->firstOrFail();
        $courses = Course::paginate(5);
  
        return view('dashboard-admin.category-detail', compact('category', 'courses'));
    }    

    public function create()
    {
        return view('dashboard-admin.category-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'description']);

        // Cek apakah ada gambar yang di-upload
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('images/kategori', 'public');
        }

        // Simpan kategori
        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {
        return view('dashboard-admin.category-edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'nullable|string',
        ]);

        $category->name = $request->input('name');
        $category->description = $request->input('description');

        // Cek apakah ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($category->image_path) {
                Storage::disk('public')->delete($category->image_path);
            }

            // Simpan gambar baru
            $category->image_path = $request->file('image')->store('images/kategori', 'public');
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        if ($category->image_path) {
            Storage::disk('public')->delete($category->image_path);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
