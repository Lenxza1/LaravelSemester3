@extends('v_layout.app')
@section('content')
<div class="container-fluid">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between">
            <h5 class="card-title fw-semibold mb-4">{{$title}}</h5>
            <a href="{{route('produk.create')}}" class="btn btn-primary mb-4">Tambah Produk</a>
        </div>
        <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">No</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Nama</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Harga</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Jumlah</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Foto</h6>
                    </th>
                    <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Aksi</h6>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$loop->iteration}}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$product->name}}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$product->price}}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{$product->amount}}</h6></td>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><img src="{{ asset($product->image) }}" alt="" width="100"></h6></td>
                            <td class="border-bottom-0">
                                <div class="d-flex gap-2">
                                    <a href="{{route('produk.edit', $product->id)}}" class="btn btn-success">
                                        Update
                                    </a>
                                    @if (Auth::user()->role == 'admin')
                                        <form action="{{route('produk.delete', $product->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" value="{{$product->id}}" class="btn btn-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection