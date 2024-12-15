@extends('v_layout.app')
@section('content')
<h3> Dashboard </h3>
<p>
    Selamat Datang, <b>{{ Auth::user()->name }}</b> pada aplikasi Toko Online dengan hak akses yang anda <br>miliki sebagai <b>
    @if (Auth::user()->role == 1)
        Super Admin
    @elseif (Auth::user()->role == 0)
        Admin
    @endif
    </b>
    ini adalah halaman utama dari aplikasi ini.
</p>
@endsection