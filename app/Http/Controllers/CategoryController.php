<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $categories = Category::where('user_id', Auth::id())
                ->withCount('tasks')
                ->latest()
                ->paginate(10);

            $categories->getCollection()->transform(function ($item) {
                return [
                    'id' => $item->id,
                    'category' => $item->category,
                    'pemilik' => Auth::user()->name,
                    'tasks_count' => $item->tasks_count,
                ];
            });

            return response()->json($categories);
        }

        return view('category.index');
    }

    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'category' => 'required|string|max:255'
        ]);

        Category::create([
            'user_id' => Auth::id(),
            'category' => $validated['category'],
        ]);

        return response()->json(['message' => 'Kategori berhasil ditambahkan'], 201);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255'
        ]);

        // Gunakan findOrFail agar jika ID salah, return 404 otomatis
        $category = Category::where('user_id', Auth::id())->findOrFail($id);

        $category->update([
            'category' => $validated['category']
        ]);

        return response()->json(['message' => 'Kategori berhasil diperbarui']);
    }

    public function destroy(string $id)
    {
        $category = Category::where('user_id', Auth::id())->findOrFail($id);

        // Validasi Relasi
        if ($category->tasks()->exists()) {
            return response()->json([
                'message' => 'Gagal! Kategori ini digunakan oleh tugas aktif.'
            ], 422);
        }

        $category->delete();

        return response()->json(['message' => 'Kategori berhasil dihapus']);
    }
}
