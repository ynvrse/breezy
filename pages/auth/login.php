<?php

global $massage;
if (isAuth()) {
    redirectTo("/dashboard");
}
?>

<div class="card w-25 mx-auto mt-5 border-2">
    <div class="card-header">
        <h1>Login</h1>

    </div>
    <div class="card-body ">
        <form method="POST">
            <p class="text-danger"><?= $massage ?></p>
            <div class="mb-2">
                <label for="email">Email<span class="text-danger">*</span></label>
                <input type="email" id="email" name="email" class="form-control" autofocus>
            </div>
            <div class="mb-2">
                <label for="password">Password<span class="text-danger">*</span></label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <div class="mb-2 d-flex justify-content-end">
                <a href="/auth/register" class="btn btn-link text">Sign up</a>
                <button type="submit" name="login" class="btn btn-dark">Login</button>
            </div>
        </form>
    </div>
</div>