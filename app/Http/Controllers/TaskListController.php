<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Status;
use App\Models\Tasklist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {

        $query = Tasklist::with('status', 'category')->where('user_id', Auth::id())->orderBy('deadline', 'asc');;

        if($request->filled('status_id')){
            $query->where('status_id', $request->status_id);
        }

        $tasklist = $query->paginate(10)->withQueryString();
          $tasklist->getCollection()->transform(function ($item) {

            // --- LOGIKA HITUNG DEADLINE (Sesuai Request) ---
            $deadlineDate = \Carbon\Carbon::parse($item->deadline)->startOfDay();
            $now = \Carbon\Carbon::now()->startOfDay();
            $diff = $now->diffInDays($deadlineDate, false); // false agar bisa negatif

            $sisa_waktu_text = "";
            $sisa_waktu_class = ""; // Class Tailwind untuk badge text

            if ($diff > 0) {
                $sisa_waktu_text = $diff . " hari lagi";
                $sisa_waktu_class = "text-emerald-700 bg-emerald-100";
            } elseif ($diff == 0) {
                $sisa_waktu_text = "Hari ini!";
                $sisa_waktu_class = "text-amber-700 bg-amber-100";
            } else {
                $sisa_waktu_text = "Terlewat " . abs($diff) . " hari";
                $sisa_waktu_class = "text-red-700 bg-red-100";
            }
            // ------------------------------------------------

            return [
                'id' => $item->id,
                'task' => $item->task,
                'deskripsi' => $item->deskripsi ?? 'Tidak ada Deskripsi Untuk Tugas ini',
                'category' => $item->category->category ?? '-',

                // Format tanggal standar
                'deadline_fmt' => \Carbon\Carbon::parse($item->deadline)->format('d M Y H:i'),

                // Data baru hasil perhitungan
                'deadline_diff' => $sisa_waktu_text,
                'deadline_class' => $sisa_waktu_class,

                'status_label' => $item->status->status ?? '-',
                'urls' => [
                    'show' => route('task.show', $item->id),
                    'edit' => route('task.edit', $item->id),
                    'delete' => route('task.destroy', $item->id),
                ],
                // Warna indikator status (dot disamping kiri)
                'colors' => match($item->status_id) {
            1 => [ // Merah (Belum Selesai)
                'sidebar' => 'bg-red-500',
                'badge'   => 'text-red-400 bg-red-900/20 border-red-700/50'
            ],
            2 => [ // Kuning/Amber (Proses)
                'sidebar' => 'bg-amber-500',
                'badge'   => 'text-amber-400 bg-amber-900/20 border-amber-700/50'
            ],
            3 => [ // Hijau (Selesai)
                'sidebar' => 'bg-emerald-500',
                'badge'   => 'text-emerald-400 bg-emerald-900/20 border-emerald-700/50'
            ],
            default => [ // Default Abu-abu
                'sidebar' => 'bg-neutral-500',
                'badge'   => 'text-neutral-400 bg-neutral-900/20 border-neutral-700/50'
            ]
        }
            ];
        });

        return response()->json($tasklist);
    }
        $statuses = Status::all();
        return view('tasklist.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $categories = Category::where('user_id', Auth::id())->get();
    $statuses = Status::all();

    // Arahkan ke folder tasklist/create.blade.php
    return view('tasklist.create', compact('categories', 'statuses'));
}

public function store(Request $request)
{
    $request->validate([
        'task' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'category_id' => 'required|exists:category,id', // Sesuaikan nama tabel categories
        'status_id' => 'required|exists:status,id',     // Sesuaikan nama tabel statuses
        'deadline' => 'required|date',
    ]);

    Tasklist::create([
        'user_id' => Auth::id(),
        'task' => $request->task,
        'deskripsi' => $request->deskripsi,
        'category_id' => $request->category_id,
        'status_id' => $request->status_id,
        'deadline' => $request->deadline,
    ]);

    return redirect()->route('task.index')->with('success', 'Tugas berhasil ditambahkan!');
}

public function show($id)
{
    $task = Tasklist::with(['category', 'status'])->where('user_id', Auth::id())->findOrFail($id);

    // --- LOGIKA HITUNG DEADLINE (Untuk View Show) ---
    $deadlineDate = Carbon::parse($task->deadline)->startOfDay();
    $now = Carbon::now()->startOfDay();
    $diff = $now->diffInDays($deadlineDate, false);

    if ($diff > 0) {
        $task->sisa_waktu = $diff . " hari lagi";
        $task->badge_class = "text-emerald-400 bg-emerald-900/30 border-emerald-700";
    } elseif ($diff == 0) {
        $task->sisa_waktu = "Hari ini!";
        $task->badge_class = "text-amber-400 bg-amber-900/30 border-amber-700";
    } else {
        $task->sisa_waktu = "Terlewat " . abs($diff) . " hari";
        $task->badge_class = "text-red-400 bg-red-900/30 border-red-700";
    }
    // ------------------------------------------------

    return view('tasklist.show', compact('task'));
}

public function edit($id)
{
    $task = Tasklist::where('user_id', Auth::id())->findOrFail($id);
    $categories = Category::where('user_id', Auth::id())->get();
    $statuses = Status::all();

    return view('tasklist.edit', compact('task', 'categories', 'statuses'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'task' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'category_id' => 'required|exists:category,id',
        'status_id' => 'required|exists:status,id',
        'deadline' => 'required|date',
    ]);

    $task = Tasklist::where('user_id', Auth::id())->findOrFail($id);

    $task->update([
        'task' => $request->task,
        'deskripsi' => $request->deskripsi,
        'category_id' => $request->category_id,
        'status_id' => $request->status_id,
        'deadline' => $request->deadline,
    ]);

    return redirect()->route('task.index')->with('success', 'Tugas berhasil diperbarui!');
}

public function destroy($id)
{
    $task = Tasklist::where('user_id', Auth::id())->findOrFail($id);
    $task->delete();

    // Return JSON karena Index menggunakan AJAX/Fetch untuk delete
    if (request()->wantsJson() || request()->ajax()) {
        return response()->json(['message' => 'Tugas berhasil dihapus']);
    }

    // Fallback jika diakses tanpa Ajax
    return redirect()->route('task.index')->with('success', 'Tugas berhasil dihapus');
}
}
