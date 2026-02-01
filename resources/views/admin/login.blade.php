<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body{font-family:Arial;background:#f5f5f5}
        .box{max-width:350px;margin:80px auto;background:#fff;padding:25px;border-radius:16px}
        input{width:100%;padding:12px;margin:8px 0;border-radius:12px;border:1px solid #ddd}
        button{width:100%;background:#000;color:#fff;padding:12px;border-radius:20px;border:none}
        .error{color:red}
    </style>
</head>
<body>

<div class="box">
    <h2>Admin Login</h2>

    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <form method="POST" action="/admin/login">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button>LOGIN</button>
    </form>
</div>

</body>
</html>
