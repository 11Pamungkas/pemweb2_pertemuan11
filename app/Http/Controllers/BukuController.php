<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Buku;
 
class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data buku
        $bukus = Buku::latest()->get();
        
        // Statistik buku
        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', '<=', 0)->count();
        
        // Data kategori & tahun untuk filter
        $kategoris = Buku::select('kategori')
                        ->distinct()
                        ->pluck('kategori');
 
        $tahuns = Buku::select('tahun_terbit')
                    ->distinct()
                    ->orderBy('tahun_terbit', 'desc')
                    ->pluck('tahun_terbit');
        
        return view('buku.index', compact(
            'bukus',
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'kategoris',
            'tahuns'
        ));
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
 
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = Buku::findOrFail($id);
        
        return view('buku.show', compact('buku'));
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
 
        return view('buku.edit', compact('buku'));
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    /**
     * Filter buku berdasarkan kategori.
     */
    public function filterKategori($kategori)
    {
        $bukus = Buku::where('kategori', $kategori)
                    ->latest()
                    ->get();
        
        $totalBuku = $bukus->count();
        $bukuTersedia = $bukus->where('stok', '>', 0)->count();
        $bukuHabis = $bukus->where('stok', '<=', 0)->count();
 
        $kategoris = Buku::select('kategori')
                        ->distinct()
                        ->pluck('kategori');
 
        $tahuns = Buku::select('tahun_terbit')
                    ->distinct()
                    ->orderBy('tahun_terbit', 'desc')
                    ->pluck('tahun_terbit');
        
        return view('buku.index', compact(
            'bukus',
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'kategori',
            'kategoris',
            'tahuns'
        ));
    }
 
    /**
     * Search & Filter Buku Advanced
     */
    public function search(Request $request)
    {
        $query = Buku::query();
 
        // Search keyword
        if ($request->keyword) {
 
            $query->where(function ($q) use ($request) {
 
                $q->where('judul', 'like', '%' . $request->keyword . '%')
                  ->orWhere('pengarang', 'like', '%' . $request->keyword . '%')
                  ->orWhere('penerbit', 'like', '%' . $request->keyword . '%');
            });
        }
 
        // Filter kategori
        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }
 
        // Filter tahun
        if ($request->tahun) {
            $query->where('tahun_terbit', $request->tahun);
        }
 
        // Filter ketersediaan
        if ($request->ketersediaan == 'tersedia') {
            $query->where('stok', '>', 0);
        }
 
        if ($request->ketersediaan == 'habis') {
            $query->where('stok', '<=', 0);
        }
 
        // Ambil hasil
        $bukus = $query->latest()->get();
 
        // Statistik berdasarkan hasil filter
        $totalBuku = $bukus->count();
        $bukuTersedia = $bukus->where('stok', '>', 0)->count();
        $bukuHabis = $bukus->where('stok', '<=', 0)->count();
 
        // Data dropdown
        $kategoris = Buku::select('kategori')
                        ->distinct()
                        ->pluck('kategori');
 
        $tahuns = Buku::select('tahun_terbit')
                    ->distinct()
                    ->orderBy('tahun_terbit', 'desc')
                    ->pluck('tahun_terbit');
 
        return view('buku.index', compact(
            'bukus',
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'kategoris',
            'tahuns'
        ));
    }
}