<li class="nav-item mb-2">
    <a href="/user/dashboard" class="{{ request()->is('user/dashboard*') ? 'active' : '' }} nav-link ">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>
<li class="nav-item mb-2">
    <a href="/user/pinjam" class="{{ request()->is('user/pinjam*') ? 'active' : '' }} nav-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
            class="bi bi-people-fill nav-icon fas fa-th" viewBox="0 0 16 16">
            <path
                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
        </svg>
        <p>
            Peminjaman Buku
            {{-- <span class="right badge badge-danger">New</span> --}}
        </p>
    </a>
</li>
