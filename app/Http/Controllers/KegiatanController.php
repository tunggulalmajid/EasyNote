<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        // === JIKA REQUEST DARI ALPINE JS (AJAX) ===
        // Kita kirimkan data JSON mentah
        if ($request->ajax() || $request->wantsJson()) {

            $query = Kegiatan::with('status')
                ->where('user_id', Auth::id())
                ->orderBy('tanggal', 'desc')
                ->orderBy('waktu', 'desc');

            // Filter Tanggal
            if ($request->filled('tanggal')) {
                $query->whereDate('tanggal', $request->tanggal);
            }

            // Filter Status
            if ($request->filled('status_id')) {
                $query->where('status_id', $request->status_id);
            }

            $kegiatan = $query->paginate(10);

            // Transformasi Data (Format Tanggal & Warna diatur di sini)
            $kegiatan->getCollection()->transform(function ($item) {
                return [
                    'id' => $item->id,
                    'kegiatan' => $item->kegiatan,
                    'deskripsi' => $item->deskripsi,
                    'tanggal_fmt' => \Carbon\Carbon::parse($item->tanggal)->format('d M Y'),
                    'waktu_fmt' => \Carbon\Carbon::parse($item->waktu)->format('H:i'),
                    'status_label' => $item->status->status ?? '-',
                    'urls' => [
                        'edit' => route('kegiatan.edit', $item->id),
                        'delete' => route('kegiatan.destroy', $item->id),
                    ],
                    // Logic Warna (Sesuaikan ID status di DB kamu)
                    'colors' => match($item->status_id) {
                        1 => ['dot' => 'bg-red-500', 'border' => 'border-l-red-500'],    // Pending
                        2 => ['dot' => 'bg-amber-500', 'border' => 'border-l-amber-500'],  // In Progress
                        3 => ['dot' => 'bg-emerald-500', 'border' => 'border-l-emerald-500'],// Done
                        default => ['dot' => 'bg-neutral-400', 'border' => 'border-l-neutral-400'],
                    }
                ];
            });

            return response()->json($kegiatan);
        }

        // === JIKA REQUEST DARI BROWSER (LOAD PERTAMA) ===
        // Kita kirimkan kerangka HTML saja
        $statuses = Status::all();
        return view('kegiatan.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::all();
        return view('kegiatan.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'kegiatan'=> 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'status_id' => 'required|exists:status,id',
            'deskripsi' => 'nullable|string'
        ]);

        Kegiatan::create([
            'user_id' => Auth::id(),
            'kegiatan'=> $request->kegiatan,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'status_id' => $request->status_id,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kegiatan = Kegiatan::with('user', 'status')->findorfail($id);
        if($kegiatan->user_id !== Auth::id()){
            abort(403);
        }
        $statuses = Status::all();



        return view ('kegiatan.edit', compact('kegiatan', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kegiatan = Kegiatan::with('user', 'status')->findorfail($id);
        if($kegiatan->user_id !== Auth::id()){
            abort(403);
        }
        $request->validate([
            'kegiatan'=> 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'status_id' => 'required|exists:status,id',
            'deskripsi' => 'nullable|string'
        ]);

        $kegiatan->update($request->all());

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->user_id !== Auth::id()) abort(403);
        $kegiatan->delete();
        // Return JSON jika dihapus via AJAX, atau redirect jika biasa
        if (request()->ajax()) {
            return response()->json(['message' => 'Deleted']);
        }
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan dihapus');
    }
}
