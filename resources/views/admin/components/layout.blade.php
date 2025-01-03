<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan Digital</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('templates/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('templates/dist/css/adminlte.min.css') }}">
    {{-- Sweet Alert 2 --}}
    <link rel="stylesheet" href="sweetalert2.min.css">
    {{-- Tailwind style --}}
    @vite('resources/css/app.css')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('admin.components.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.components.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    @yield('header')
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('templates/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('templates/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('templates/dist/js/adminlte.min.js') }}"></script>
    {{-- Sweet Alert 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('added'))
            Swal.fire({
                title: "Berhasil",
                text: "Data berhasil disimpan!",
                icon: "success"
            });
        @endif

        @if (session('updated'))
            Swal.fire({
                title: "Berhasil",
                text: "Data berhasil diubah!",
                icon: "success"
            });
        @endif

        function hapus(button) {
            Swal.fire({
                title: "Hapus Data",
                text: "Yakin ingin hapus data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.parentElement.submit();
                };
            });
        }

        @if (session('deleted'))
            Swal.fire({
                title: "Berhasil",
                text: "Data berhasil dihapus!",
                icon: "success"
            });
        @endif

        function approve_peminjaman(button) {
            Swal.fire({
                title: "Terima Peminjaman Buku",
                text: "Apakah anda ingin menyetujui peminjaman ini?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.parentElement.submit();
                };
            });
        }

        @if (session('approved'))
            Swal.fire({
                title: "Berhasil",
                text: "Peminjaman berhasil!",
                icon: "success"
            });
        @endif

        function reject_peminjaman(button) {
            Swal.fire({
                title: "Tolak Peminjaman Buku",
                text: "Apakah anda ingin menolak peminjaman ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.parentElement.submit();
                };
            });
        }

        @if (session('rejected'))
            Swal.fire({
                title: "Berhasil",
                text: "Peminjaman ditolak!",
                icon: "error"
            });
        @endif

        function approve_pengembalian(button) {
            Swal.fire({
                title: "Terima Pengembalian Buku",
                text: "Apakah anda ingin menyetujui pengembalian buku ini?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.parentElement.submit();
                };
            });
        }

        @if (session('approved_pengembalian'))
            Swal.fire({
                title: "Berhasil",
                text: "Pengembalian berhasil!",
                icon: "success"
            });
        @endif

        function reject_pengembalian(button) {
            Swal.fire({
                title: "Tolak Pengembalian Buku",
                text: "Apakah anda ingin menolak pengembalian buku ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.parentElement.submit();
                };
            });
        }

        @if (session('rejected_pengembalian'))
            Swal.fire({
                title: "Berhasil",
                text: "Pengembalian ditolak!",
                icon: "error"
            });
        @endif
    </script>
</body>

</html>
