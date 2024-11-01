<?php if (getURI() !== "/auth/login" && getURI() !== "/auth/register"): ?>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid px-5">
                <a class="navbar-brand" href="#">
                    <h3>
                        Yon<span class="text-danger">*</span>
                    </h3>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
                    <ul class="navbar-nav text-bold">

                    </ul>

                    <div class="d-flex gap-3">

                        <a href="/auth/login" class="btn btn-dark">Login</a>
                        <a href="/auth/register" class="btn btn-outline-dark">Register</a>
                    </div>



                </div>
            </div>
        </nav>

    </header>
<?php endif; ?>