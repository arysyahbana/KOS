<footer class="footer bg-light">
    <div
        class="container-fluid d-flex flex-md-row flex-column justify-content-between align-items-md-center gap-1 container-p-x py-3">
        <div>
            <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/"
                target="_blank" class="footer-text fw-bold">Sneat</a>
            ©
        </div>
        <div>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="btn btn-sm btn-outline-danger"><i class="bx bx-log-out-circle me-1"></i>Logout</button>
            </form>
        </div>
    </div>
</footer>
