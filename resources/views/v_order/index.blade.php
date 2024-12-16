@extends('v_layout.app')
@section('content')
<div class="container-fluid">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between">
            <h5 class="card-title fw-semibold mb-4">{{$title}}</h5>
            @if (Auth::user()->role == 'customer')
                <a href="{{route('order.create')}}" class="btn btn-primary mb-4">Tambah Order</a>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">No</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">ID Order</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Nama Produk</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Jumlah</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Total</h6>
                        </th>
                        @if (Auth::user()->role == 'customer')
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Status</h6>
                            </th>
                        @endif
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Aksi</h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$loop->iteration}}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$order->id}}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$order->produk->name}}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$order->amount}}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$order->produk->price * $order->amount}}</h6></td>
                            @if (Auth::user()->role == 'customer')
                                @if ($order->status == 'pending')
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-danger rounded-3 fw-semibold">Pending</span>
                                    </div>
                                </td>
                                @elseif ($order->status == 'success')
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-success rounded-3 fw-semibold">Success</span>
                                        </div>
                                    </td>
                                @elseif ($order->status == 'cancel')
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-danger rounded-3 fw-semibold">Cancel</span>
                                        </div>
                                    </td>
                                @endif
                            @endif
                            @if (Auth::user()->role == 'customer')
                                <td class="border-bottom-0">
                                    <a href="{{route('order.edit', $order->id)}}" class="btn btn-warning">Edit</a>
                                    <form action="{{route('order.delete', $order->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            @endif
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                                <td class="border-bottom-0">
                                    <div class="d-flex gap-2">
                                        <form action="{{route('transaksi.store')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="idOrder" value="{{$order->id}}">
                                            <button type="submit" class="btn btn-primary">Proses Transaksi</button>
                                        </form>
                                        <form action="{{route('order.delete', $order->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>  
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection