<?php


global $massage;
?>

<div class="card w-25 mx-auto mt-5 border-2">
    <div class="card-header">
        <h1>SignUp</h1>
        <p class="text-sm text-danger">Buat akun baru</p>

    </div>
    <div class="card-body ">
        <form method="POST">
            <p class="text-danger"><?= $massage ?></p>
            <div class="mb-2">
                <label for="email">Nama<span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control" autofocus>
            </div>
            <div class="mb-2">
                <label for="email">Email<span class="text-danger">*</span></label>
                <input type="email" id="email" name="email" class="form-control" autofocus>
            </div>
            <div class="mb-2">
                <label for="password">Password<span class="text-danger">*</span></label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <div class="mb-2 d-flex justify-content-end">
                <a href="/auth/login" class="btn btn-link text">Login</a>
                <button type="submit" name="register" class="btn btn-dark">SignUp</button>
            </div>
        </form>
    </div>
</div>