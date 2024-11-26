<li class="nav-item mb-2">
    <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard*') ? 'active' : '' }} nav-link ">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>
<li class="nav-item mb-2">
    <a href="/admin/anggota" class="{{ request()->is('admin/anggota*') ? 'active' : '' }} nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
            class="bi bi-people-fill nav-icon fas fa-th" viewBox="0 0 16 16">
            <path
                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
        </svg>
        <p>
            Data Anggota
            {{-- <span class="right badge badge-danger">New</span> --}}
        </p>
    </a>
</li>
<li class="nav-item mb-2">
    <a href="/admin/buku" class="{{ request()->is('admin/buku*') ? 'active' : '' }} nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
            class="bi bi-bookmarks-fill nav-icon fas fa-th" viewBox="0 0 16 16">
            <path
                d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5z" />
            <path d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1z" />
        </svg>
        <p>
            Data Buku
        </p>
    </a>
</li>
<li class="nav-item mb-2">
    <a href="/admin/pinjam" class="{{ request()->is('admin/pinjam*') ? 'active' : '' }} nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
            class="bi bi-bookmark-dash-fill nav-icon fas fa-th" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5M6 6a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1z" />
        </svg>
        <p>
            Peminjaman Buku
        </p>
    </a>
</li>
<li class="nav-item mb-2">
    <a href="/admin/kembali" class="{{ request()->is('admin/kembali*') ? 'active' : '' }} nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
            class="bi bi-bookmark-check-fill nav-icon fas fa-th" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
        </svg>
        <p>
            Pengembalian Buku
        </p>
    </a>
</li>
