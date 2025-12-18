<?php

namespace App\Http\Controllers;

use App\Models\Catatan; // Pastikan Model diawali Huruf Besar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Tambahkan ini untuk memotong text panjang
use Carbon\Carbon;

class CatatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Mengambil data urut dari yang terbaru
            $catatan = Catatan::where('user_id', Auth::id())->latest()->paginate(10);

            $catatan->getCollection()->transform(function ($item) {
                return [
                    'id' => $item->id,
                    'judul' => $item->judul,
                    // Kita kirim konten full untuk keperluan lain, tapi buat excerpt untuk list
                    'konten_cuplikan' => Str::limit($item->konten, 100, '...'),
                    'konten_full' => $item->konten,

                    // FORMAT TANGGAL (Penting agar UI bagus)
                    // Format: 19 Dec 2025
                    'tanggaldibuat' => Carbon::parse($item->created_at)->format('d M Y'),
                    // Format relative: 2 hours ago / 1 hari yang lalu
                    'tanggaldibuat_diff' => Carbon::parse($item->created_at)->diffForHumans(),

                    'urls' => [
                        'show' => route('catatan.show', $item->id),
                        'edit' => route('catatan.edit', $item->id),
                        'delete' => route('catatan.destroy', $item->id),
                    ]
                ];
            });

            return response()->json($catatan);
        }

        return view('catatan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('catatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string'
        ]);

        Catatan::create([
            'user_id' => Auth::id(),
            'judul' => $validated['judul'],
            'konten' => $validated['konten'],
        ]);

        return redirect()->route('catatan.index')->with('success', 'Catatan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $catatan = Catatan::where('user_id', Auth::id())->findOrFail($id);
        return view('catatan.show', compact('catatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $catatan = Catatan::where('user_id', Auth::id())->findOrFail($id);
        return view('catatan.edit', compact('catatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string'
        ]);

        $catatan = Catatan::where('user_id', Auth::id())->findOrFail($id);

        $catatan->update([
            // User ID tidak perlu di-update ulang, cukup judul dan konten
            'judul' => $validated['judul'],
            'konten' => $validated['konten'],
        ]);

        return redirect()->route('catatan.index')->with('success', 'Catatan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $catatan = Catatan::where('user_id', Auth::id())->findOrFail($id);
        $catatan->delete();

        // Return JSON jika dihapus via AJAX (sesuai pola index kita)
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['message' => 'Catatan berhasil dihapus']);
        }

        return redirect()->route('catatan.index')->with('success', 'Catatan berhasil dihapus');
    }
}
