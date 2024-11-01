<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid px-lg-5">
            <a class="navbar-brand" href="#">
                <h3 class="fw-bold">
                    Yon<span class="text-danger">*</span>
                </h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
                <ul class="navbar-nav text-bold">

                    <?php include("nav-link.php"); ?>
                </ul>
                <nav class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?= user('name') ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="/profile">
                                <i data-lucide="user" class="me-2"></i> Profile</a>
                        </li>
                        <li>
                            <form method="POST" class="d-inline">
                                <button type="submit" name="logout" class="dropdown-item text-dark">
                                    <i data-lucide="log-out" class="me-2"></i> Log Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </nav>

</header>