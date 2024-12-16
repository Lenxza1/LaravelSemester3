@extends('v_layout.app')
@section('content')
<h3> {{$title}} </h3>
<p>
    Selamat Datang, <b>{{ Auth::user()->name }}</b> pada aplikasi Toko Online dengan hak akses yang anda <br>miliki sebagai <b>
    @if (Auth::user()->role == 'admin')
        Admin
    @elseif (Auth::user()->role == 'staff')
        Staff
    @else
        Customers
    @endif
    </b>
    ini adalah halaman utama dari aplikasi ini.
</p>
@endsection