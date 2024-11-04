<?php

if (isset($_POST["hapus-user"]) && isset($_POST["id"])) {

    $id = $_POST["id"];
    $user = $DB->prepare("DELETE FROM users WHERE id=? ");
    $user->bind_param('i', $id);
    $user->execute();

    Toast("Hapus User Berhasil", 'success');
    redirectTo(getURI());
}

?>
<div class="card boder-dark">
    <div class="card-header fw-bold">
        List Users
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="text-center fw-bold">
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody class="text-center fw-bold">
                <?php
                $authId = user('id');
                $users = $DB->query("SELECT * FROM users WHERE id !='$authId' ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);
                $no = 1;
                foreach ($users as $user):
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                            <div class="d-flex gap-3 justify-content-center">
                                <a href="/user/<?= $user['id'] ?>" class="btn btn-dark">Edit</a>
                                <form method="post">
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                    <button onclick="return confirm('Yakin ingin menghapus user ini?')" type="submit"
                                        name="hapus-user" class="btn btn-outline-danger">Hapus</>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>