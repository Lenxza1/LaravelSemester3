<style>
    table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ccc;
    }

    table tr td {
        padding: 6px;
        font-weight: normal;
        border: 1px solid #ccc;
    }

    table th {
        border: 1px solid #ccc;
    }
</style>
<table>
    <!-- <tr>
        <td align="center">
            <img src="{{ asset('images/header.png') }}" width="50%">
        </td>
    </tr> -->
    <tr>
        <td align="left">
            Perihal : {{ $title }} <br>
            Tanggal Awal: {{ $start_date }} s/d Tanggal Akhir: {{ $end_date }}
        </td>
    </tr>
</table>
<p></p>
<table>
    <thead>
        <tr>
            <th><h6>No</h6></th>
            <th><h6>Nama Customer</h6></th>
            <th><h6>Email Customer</h6></th>
            <th><h6>Nama Produk</h6></th>
            <th><h6>Total Pesanan</h6></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaction as $transaksi)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$transaksi->order->user->name}}</td>
                <td>{{$transaksi->order->user->email}}</td>
                <td>{{$transaksi->order->produk->name}}</td>
                <td>{{$transaksi->total}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    window.onload = function () {
        printStruk();
    }
    function printStruk() {
        window.print();
    }
</script>