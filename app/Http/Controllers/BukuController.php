<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Gallery;
use Intervention\Image\Facades\Image;

class BukuController extends Controller
{

    
    public function index()
    {  
         
        $batas = 5;
        //jumlah data buku
        $jumlahData = Buku::count();
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);;
        $no = $batas * ($data_buku->currentPage() - 1);
        //jumlah harga seluruh buku
        $totalHarga = Buku::sum('harga');
        return view('buku.index', compact('data_buku','no', 'jumlahData', 'totalHarga'));
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
    public function store(Request $request){
        $this->validate($request,[
        'judul' => 'required|string',
        'penulis' => 'required| string|max:30',
        'harga' => 'required|numeric',
        'tgl_terbit' => 'required|date' 
    ]);
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = date('Y-m-d', strtotime($request->tgl_terbit));
        $buku->save();
        return redirect('/buku')->with('pesan','Data Buku Berhasil di Simpan');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, string $id) {
        $buku = Buku::find($id);
    
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);
    
        if ($request->hasFile('thumbnail')) {
            $fileName = time() . '_' . $request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');
    
            // Thumbnail processing code
            Image::make(storage_path().'/app/public/uploads/'.$fileName)
                ->fit(240, 320)
                ->save();
    
            $buku->update([
                'judul'     => $request->judul,
                'penulis'   => $request->penulis,
                'harga'     => $request->harga,
                'tgl_terbit'=> $request->tgl_terbit,
                'filename'  => $fileName,
                'filepath'  => '/storage/' . $filePath
            ]);
        }
    
        if ($request->hasFile('gallery')) {
            foreach($request->file('gallery') as $key => $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
    
                $gallery = Gallery::create([
                    'nama_galeri'   => $fileName,
                    'path'          => '/storage/' . $filePath,
                    'foto'          => $fileName,
                    'buku_id'       => $id
                ]);
            }
        }
    
        return redirect('/buku')->with('pesan', 'Perubahan Data Buku Berhasil di Simpan');
    }
    
    
    // public function update(Request $request, string $id)
    // {
    //     $buku = Buku::find($id);

    //     $request->validate([
    //         'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048'
    //     ]);

    //     $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
    //     $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');

    //     Image::make(storage_path().'/app/public/uploads/'.$fileName)
    //         ->fit(240,320)
    //         ->save();

    //     $buku->update([
    //         'judul'     => $request->judul,
    //         'penulis'   => $request->penulis,
    //         'harga'     => $request->harga,
    //         'tgl_terbit'=> $request->tgl_terbit,
    //         'filename'  => $fileName,
    //         'filepath'  => '/storage/' . $filePath
    //     ]);
    //     return redirect('/buku')->with('pesan','Data Buku Berhasil di Perbarui');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku')->with('pesan','Data Buku Berhasil di Hapus');
    }

    public function search(Request $request){
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%".$cari."%")->orwhere('penulis','like',"%".$cari."%")
        ->simplePaginate($batas);
        $jumlahData = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() -1);
        $total = Buku::sum('harga');
        return view('Buku.search', compact('data_buku', 'no','jumlahData','total','cari'));
    }

    public function __construct(){
        $this->middleware('auth');
    }  

    public function deleteImage($buku_id, $image_id) {
        $buku = Buku::find($buku_id);
        $image = Gallery::find($image_id);
    
        if ($image && $buku && $image->buku_id === $buku->id) {
            $image->delete();
            return back()->with('pesan', 'Gambar Berhasil Dihapus');
        } else {
            return back()->with('error', 'Gambar Tidak Ditemukan');
        }
    }

}
