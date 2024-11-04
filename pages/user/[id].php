<?php
$id = getParam('id');

$user = $DB->query("SELECT name, email FROM users WHERE id='$id' LIMIT 1")->fetch_assoc();


?>

<div class="card">
    <div class="card-header fw-bold h4">
        Detail User <?= $user['name'] ?>
    </div>
    <div class="card-body">
        <div class="row">

            <div class="col-md-6">

                <input readonly value="<?= htmlspecialchars($user['name']) ?>" type="text" name="name" id="name"
                    class="form-control">
            </div>
            <div class="col-md-6">

                <input type="email" readonly value="<?= htmlspecialchars($user['email']) ?>" name="email" id="email"
                    class="form-control">
            </div>
        </div>
        <div class="mt-3 d-flex justify-content-end">
            <button type="button" onclick="history.back()" class="btn btn-outline-dark">
                Kembali
            </button>

        </div>
        </form>
    </div>
</div>