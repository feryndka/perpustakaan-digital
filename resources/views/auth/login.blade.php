<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .div {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            width: 400px;
            margin: 20px 20px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            background-color: white;
        }

        .login-footer {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="div">
        <div class="login-container p-4">
            <h2 class="text-center mb-4">Login</h2>
            {{-- verifikasi authentikasi login anggota --}}
            <form action="{{ route('auth.verify') }}" method="POST">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                        required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required>
                </div>
                @if (session('msg'))
                    <p class="text-danger">* {{ session('msg') }}</p>
                @endif
                <button type="submit" class="btn btn-dark w-100">Masuk</button>
            </form>
            <div class="login-footer mt-3">
                <p>Belum Punya Akun? <a href="/registrasi" class="text-decoration-none">Registrasi</a></p>
            </div>
        </div>
    </div>

    {{-- import script bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
