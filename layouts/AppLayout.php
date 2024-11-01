<?php

include 'partials/header.php';
include 'partials/navbar.php';
// include 'partials/sidebar.php';
Auth();

?>

<div class="position-fixed top-3 end-0 p-3" style="z-index: 1050;">
    <?php showToast() ?>
</div>



<main class="d-flex flex-column ">
    <div class="container-fluid px-lg-5 flex-grow-1 d-flex align-items-stretch">
        <div class="card mt-4 w-100 bg-light">
            <div class="card-body" style="height: calc(100vh - 100px); overflow-y: auto;">
                <?php include $content; ?>
            </div>
        </div>
    </div>
</main>



<?php include 'partials/footer.php'; ?>