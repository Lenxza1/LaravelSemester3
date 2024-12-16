<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::orderBy('updated_at', 'desc')->get();

        return view('v_transaksi.index', [
            'title' => 'Transaksi',
            'transaction' => $transaksi,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'idOrder' => 'required',
            ]);

            $id = $request->idOrder;

            $order = Order::findOrFail($id);

            Transaksi::create([
                'idPetugas' => auth()->user()->id,
                'idOrder' => $order->id,
                'total' => $order->produk->price * $order->amount,
            ]);

            $order->update([
                'status' => 'success',
            ]);

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dilakukan');
        } catch (\Throwable $th) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi gagal dilakukan');
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
        //
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

    public function print(Request $request)
    {
        try {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ],
            [
                'start_date.required' => 'Tanggal awal harus diisi',
                'end_date.required' => 'Tanggal akhir harus diisi',
                'end_date.after_or_equal' => 'Tanggal akhir harus lebih besar atau sama dengan tanggal awal',
            ]);

            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $transaksi = Transaksi::whereBetween('created_at', [
                date('Y-m-d', strtotime($start_date . ' -1 day')),
                date('Y-m-d', strtotime($end_date . ' +1 day'))
            ])->orderBy('id', 'desc')->get();

            return view('v_transaksi.print', [
                'title' => 'Transaksi',
                'start_date' => $start_date,
                'end_date' => $end_date,
                'transaction' => $transaksi,
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi gagal dicetak');
        }   
    }
}
