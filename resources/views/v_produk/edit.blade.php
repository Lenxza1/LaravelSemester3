@extends('v_layout.app')
@section('content')
<div class="container-fluid">
    <div class="card-body p-4">
        <h5 class="card-title fw-semibold mb-4">{{$title}}</h5>
        <form action="{{route('produk.update', $product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" placeholder="Masukan Nama Produk" value="{{ $product->name ?? '' }}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Harga</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="price" placeholder="Masukan Harga Produk" value="{{ $product->price ?? '' }}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Kuantitas</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="amount" placeholder="Masukan Jumlah Produk" value="{{ $product->amount ?? '' }}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Foto</label>
                <input type="file" class="form-control" id="exampleInputPassword1" name="image" accept="image/*">
                @if(isset($product->image))
                    <img src="{{ asset( $product->image) }}" alt="Product Image" class="mt-2" style="max-width: 200px;">
                @endif
            </div>
            <div style="margin-top: 4rem; display: flex; justify-content: end; gap: 1rem;">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <a href="{{route('produk.index')}}" class="btn btn-warning">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection