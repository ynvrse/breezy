<?php
include 'partials/header.php';
include 'partials/guest-navbar.php';
// include 'partials/sidebar.php';
?>

<div class="position-fixed top-3 end-0 p-3" style="z-index: 1050;">
    <?php showToast(); ?>
</div>

<main class="d-flex flex-column ">
    <div class="container-fluid px-5 flex-grow-1 d-flex align-items-stretch">
        <?php if (getURI() !== "/auth/login" && getURI() !== "/auth/register"): ?>
            <div class="card w-100 mt-4">
                <div class="card-body bg-light" style="height: calc(100vh - 100px); overflow-y: auto;">
                    <?php include $content; ?>
                </div>
            </div>
        <?php else: ?>
            <?php include $content; ?>
        <?php endif; ?>
    </div>
</main>




<?php include 'partials/footer.php'; ?>