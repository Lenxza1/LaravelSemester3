<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Produk::orderBy('updated_at', 'desc')->get();

        return view('v_produk.index', [
            'title' => 'Produk',
            'products' => $product,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('v_produk.create', [
            'title' => 'Tambah Produk',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'price' => 'required|numeric',
                'amount' => 'required|numeric',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            ]);
    
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $directory = '/img/produk';

            $savedImage = ImageHelper::uploadAndResize($image, $directory, $fileName, height: 300);
            
            Produk::create([
                'name' => $request->name,
                'price' => $request->price,
                'amount' => $request->amount,
                'image' => $directory . '/' . $savedImage,
            ]);
    
            return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('produk.index')->with('error', $th->getMessage());
        }
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
        return view('v_produk.edit', [
            'title' => 'Edit Produk',
            'product' => Produk::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'price' => 'required|numeric',
                'amount' => 'required|numeric',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            ]);
    
            $product = Produk::findOrFail($id);
    
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $directory = '/img/produk';

            if ($product->image) {
                $oldImage = public_path($product->image);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
    
            if ($image) {
                $savedImage = ImageHelper::uploadAndResize($image, $directory, $fileName, height: 300);
                $product->update([
                    'name' => $request->name,
                    'price' => $request->price,
                    'amount' => $request->amount,
                    'image' => $directory . '/' . $savedImage,
                ]);
            } else {
                $product->update([
                    'name' => $request->name,
                    'price' => $request->price,
                    'amount' => $request->amount,
                ]);
            }
    
            return redirect()->route('produk.index')->with('success', 'Produk berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('produk.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Produk::findOrFail($id);
            $product->delete();

            $image = public_path($product->image);
            if (file_exists($image)) {
                unlink($image);
            }
    
            return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
        }  catch(\Illuminate\Database\QueryException $e) {                
            return redirect()->route('produk.index')->with('error', 'Produk tidak bisa dihapus karena sudah ada transaksi yang menggunakan produk ini');
        } catch (\Throwable $th) {
            return redirect()->route('produk.index')->with('error', $th->getMessage());
        }
    }
}
