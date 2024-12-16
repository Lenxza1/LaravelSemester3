@extends('v_layout.app')
@section('content')
<div class="container-fluid">
    <div class="card-body p-4">
        <h5 class="card-title fw-semibold mb-4">{{$title}}</h5>
        <form method="post" action="{{route('order.store')}}">
            @csrf
            <div class="form-group mb-4">
                <label for="exampleFormControlSelect1" class="form-label">Nama Produk</label>
                <select class="form-control" id="exampleFormControlSelect1" name="idProduct">
                    @foreach ($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Jumlah Pesanan</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="amount" placeholder="Masukan Jumlah Pesanan">
            </div>
            <div style="margin-top: 4rem; display: flex; justify-content: end; gap: 1rem;">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <a href="{{route('order.index')}}" class="btn btn-warning">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection