<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Transaksi</title>
<style>
body{
    font-family:Inter;
    background:#111;
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}
form{
    background:rgba(255,255,255,.18);
    padding:30px;
    border-radius:30px;
    backdrop-filter:blur(20px);
}
input{
    width:100%;
    padding:14px;
    margin-bottom:14px;
    border-radius:16px;
    border:none;
}
button{
    width:100%;
    padding:14px;
    border:none;
    border-radius:16px;
    background:#22c55e;
    font-size:16px;
}
</style>
</head>
<body>

<form method="POST" action="/admin/update/{{ $trx->id }}">
@csrf
<input name="name" value="{{ $trx->name }}">
<input name="phone" value="{{ $trx->phone }}">
<input name="address" value="{{ $trx->address }}">
<input name="product" value="{{ $trx->product }}">
<input name="duration" value="{{ $trx->duration }}">
<input name="qty" value="{{ $trx->qty }}">
<input name="total" value="{{ $trx->total }}">
<button>Simpan</button>
</form>


</body>
</html>
