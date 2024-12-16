<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 'admin' || auth()->user()->role == 'staff') {
            $order = Order::doesntHave('transaksi')
            ->orderBy('updated_at', 'desc')
            ->get();

            return view('v_order.index', [
                'title' => 'Order',
                'orders' => $order,
            ]);
        } else {
            $order = Order::where('idUser', auth()->user()->id)
            ->orderBy('updated_at', 'desc')
            ->get();

            return view('v_order.index', [
                'title' => 'Order',
                'orders' => $order,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Produk::orderBy('name', 'asc')->get();

        return view('v_order.create', [
            'title' => 'Tambah Order',
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'idProduct' => 'required|exists:products,id',
                'amount' => 'required|numeric',
            ]);

            $product = Produk::find($request->idProduct);

            Order::create([
                'idUser' => auth()->user()->id,
                'idProduk' => $product->id,
                'amount' => $request->amount,
                'status' => 'pending',
            ]);

            return redirect()->route('order.index')->with('success', 'Order berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('order.index')->with('error', 'Order gagal ditambahkan');
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
        $products = Produk::orderBy('name', 'asc')->get();
        $order = Order::find($id);

        return view('v_order.edit', [
            'title' => 'Edit Order',
            'products' => $products,
            'order' => $order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'idProduct' => 'required|exists:products,id',
                'amount' => 'required|numeric',
            ]);

            $product = Produk::find($request->idProduct);
            $order = Order::find($id);

            $order->update([
                'idUser' => auth()->user()->id,
                'idProduk' => $product->id,
                'amount' => $request->amount,
            ]);

            return redirect()->route('order.index')->with('success', 'Order berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('order.index')->with('error', 'Order gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $order = Order::find($id);
            $order->delete();

            return redirect()->route('order.index')->with('success', 'Order berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('order.index')->with('error', 'Order gagal dihapus');
        }
    }
}
