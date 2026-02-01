<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>

<style>
body{
    margin:0;
    font-family:Inter,Arial;
    background:url('{{ asset("assets/hijau.jpeg") }}') center/cover fixed;
}
.overlay{
    min-height:100vh;
    backdrop-filter:blur(20px);
    background:rgba(0,0,0,.45);
    padding:40px;
}
.card{
    max-width:1200px;
    margin:auto;
    background:rgba(255,255,255,.22);
    border-radius:40px;
    padding:30px;
    backdrop-filter:blur(25px);
    color:#fff;
}
h1{
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
}
th,td{
    padding:14px;
    border-bottom:1px solid rgba(255,255,255,.2);
}
th{text-align:left}

button{
    border:none;
    padding:8px 14px;
    border-radius:12px;
    cursor:pointer;
}
.done{background:#22c55e;color:#000}
.edit{background:#facc15}
.del{background:#ef4444;color:#fff}
</style>
</head>

<body>
<div class="overlay">
<div class="card">

<h1>Data Transaksi</h1>

@if($data->count() == 0)
    <p>Belum ada transaksi.</p>
@else
<table>
<tr>
    <th>Nama</th>
    <th>Produk</th>
    <th>Durasi</th>
    <th>Qty</th>
    <th>Total</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

@foreach($data as $d)
<tr>
    <td>{{ $d->name }}</td>
    <td>{{ $d->product }}</td>
    <td>{{ $d->duration }}</td>
    <td>{{ $d->qty }}</td>
    <td>Rp {{ number_format($d->total) }}</td>
    <td>{{ $d->status }}</td>
    <td>

        @if($d->status !== 'completed')
        <form method="POST" action="/admin/done/{{ $d->id }}" style="display:inline">
            @csrf
            <button class="done">Selesai</button>
        </form>
        @endif

        <a href="/admin/edit/{{ $d->id }}">
            <button class="edit">Edit</button>
        </a>

        <form method="POST" action="/admin/delete/{{ $d->id }}" style="display:inline">
            @csrf
            <button class="del">Hapus</button>
        </form>

    </td>
</tr>
@endforeach

</table>
@endif

</div>
</div>
</body>
</html>
