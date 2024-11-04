<?php
function active($url)
{
    return getURI() === $url ? "active" : '';
}

$navLinks = [
    [
        'url' => '/dashboard',
        'label' => 'Dashboard'
    ],
    [
        'url' => '/user',
        'label' => 'Users'
    ]
];

?>

<!-- HTML untuk menampilkan navigasi -->
<div class="d-flex h6">
    <?php foreach ($navLinks as $link): ?>
        <li class="nav-item">
            <a class="nav-link <?= active($link['url']) ?> " aria-current="page"
                href="<?= htmlspecialchars($link['url']) ?>">

                <?= htmlspecialchars($link['label']) ?>

            </a>
        </li>
    <?php endforeach; ?>
</div>