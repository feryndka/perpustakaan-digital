<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi</title>
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
            width: 600px;
            margin: 20px 20px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .form-check-label {
            margin-bottom: 0;
        }

        .login-footer {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="div">
        <div class="login-container bg-white p-4">
            <h2 class="text-center mb-4">Registrasi</h2>
            <form action="{{ route('registrasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-3 form-group">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                    @error('nama')
                        <span class="invalid-feedback">*{{ $message }}</span>
                    @enderror
                    <small class="text-muted">Nama wajib diisi dan hanya boleh mengandung huruf dan spasi (maks. 32 karakter).</small>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                        name="alamat" placeholder="Alamat" value="{{ old('alamat') }}" required>
                    @error('alamat')
                        <span class="invalid-feedback">*{{ $message }}</span>
                    @enderror
                    <small class="text-muted">Alamat wajib diisi (minimal 5 karakter).</small>
                </div>
                <div class="mb-3">
                    <label for="noHP" class="form-label">Nomor Telepon</label>
                    <input type="number" class="form-control @error('noHP') is-invalid @enderror" id="noHP"
                        name="noHP" placeholder="Nomor Telepon" value="{{ old('noHP') }}" required>
                    @error('noHP')
                        <span class="invalid-feedback">*{{ $message }}</span>
                    @enderror
                    <small class="text-muted">Nomor Telepon wajib diisi diawali dengan 0, tanpa kode negara.</small>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                        name="username" placeholder="Username" value="{{ old('username') }}" required>
                    @error('username')
                        <span class="invalid-feedback">*{{ $message }}</span>
                    @enderror
                    <small class="text-muted">Username wajib diisi, harus unik (minimal 6, maksimal 32 karakter, tidak boleh mengandung spasi).</small>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Password" value="{{ old('password') }}" required>
                    @error('password')
                        <span class="invalid-feedback">*{{ $message }}</span>
                    @enderror
                    <small class="text-muted">Password wajib diisi (minimal 8 karakter, mengandung kombinasi huruf besar, huruf kecil, angka, dan karakter khusus seperti @$!%*?&).</small>
                </div>
                <button type="submit" class="btn btn-dark w-100">Registrasi</button>
            </form>
            <div class="login-footer mt-3">
                <p>Sudah Punya Akun? <a href="{{ route('login') }}" class="text-decoration-none">Login</a></p>
            </div>
        </div>
    </div>

    {{-- import script bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
