@extends('v_layout.app')
@section('content')
<div class="container-fluid">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between">
            <h5 class="card-title fw-semibold mb-4">{{$title}}</h5>
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#dateModal">
                Cetak Transaksi
            </button>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dateModalLabel">Pilih Tanggal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('transaksi.print') }}" method="GET">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Tanggal Awal</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">No</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Nama Customer</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Email Customer</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Nama Produk</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Total Pesanan</h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaction as $transaksi)
                        <tr>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$loop->iteration}}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$transaksi->order->user->name}}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$transaksi->order->user->email}}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$transaksi->order->produk->name}}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$transaksi->total}}</h6></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection