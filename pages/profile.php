<?php

if (isset($_POST['edit_password'])) {
    $newPassword = trim($_POST['new_password'] ?? '');
    $confirmPassword = trim($_POST['confirm_password'] ?? '');

    // 1. Validasi jika input password baru tidak kosong
    if (!empty($newPassword) && !empty($confirmPassword)) {

        // 2. Validasi apakah password baru sesuai dengan konfirmasi password
        if ($newPassword === $confirmPassword) {
            $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $userId = user('id');

            // 3. Eksekusi query untuk memperbarui kata sandi
            $qUpdatePass = $DB->prepare("UPDATE users SET password=? WHERE id=?");
            $qUpdatePass->bind_param("si", $passwordHash, $userId);
            $result = $qUpdatePass->execute();

            if ($result && $DB->affected_rows > 0) {
                Toast("Password berhasil diubah!", 'success');
                redirectTo(getURI());
            } else {
                Toast("Gagal memperbarui password. Coba lagi.", 'danger');
                redirectTo(getURI());
            }
        } else {
            Toast("Password baru dan konfirmasi password tidak sesuai!", 'danger');
            redirectTo(getURI());

        }
    } else {
        Toast('Password baru dan konfirmasi password tidak boleh kosong.', 'info');
        redirectTo(getURI());

    }
}

if (isset($_POST['update_profile'])) {
    $newName = trim($_POST['name']);
    $newEmail = trim($_POST['email']);

    $id = user('id');
    $photoPath = null;

    try {
        // Periksa apakah ada file foto yang di-upload
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $photoPath = uploadFile($_FILES['photo']);
        }

        // Update profile dengan bind parameter
        $updateProfile = $DB->prepare("UPDATE users SET name=?, email=?, photo=IFNULL(?, photo) WHERE id=?");
        $updateProfile->bind_param("sssi", $newName, $newEmail, $photoPath, $id);
        $updateProfile->execute();

        // Refresh data pengguna setelah pembaruan profil
        Toast('Berhasil Update Profile', 'success');

        // Gunakan prepared statement untuk keamanan
        $stmt = $DB->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $newUsers = $stmt->get_result()->fetch_assoc();

        $_SESSION['users'] = $newUsers;
        redirectTo(getURI());

    } catch (Exception $e) {
        Toast("Gagal memperbarui profil: " . $e->getMessage(), 'danger');
    }
}


if (isset($_POST['delete-user'])) {
    $id = user('id');
    $passwordConfirm = $_POST['password_confirm_delete'] ?? null;

    $user = $DB->query("SELECT password FROM users WHERE id='{$id}' LIMIT 1")->fetch_assoc();

    try {
        // 6. Hapus akun dengan konfirmasi dan session_destroy
        if (password_verify($passwordConfirm, $user["password"])) {

            $deleteUser = $DB->prepare("DELETE FROM users WHERE id=?");
            $deleteUser->bind_param("i", $id);
            $deleteUser->execute();

            Toast("Akun Berhasil Dihapus!", 'success');
            session_destroy();
            redirectTo('/home');
        } else {
            Toast("Password Salah", 'danger');
            redirectTo(getURI());

        }
    } catch (Exception $e) {
        Toast("GAGAL menghapus akun: " . $e->getMessage(), 'danger');
    }
}
?>

<div>
    <!-- Card untuk Edit Profile -->
    <div class="card mb-3 border-dark">
        <div class="card-header  bg-white  fw-bold">

            Edit Profile
        </div>
        <div class="card-body">
            <p class="text-muted">Ubah nama dan email Anda di sini untuk memperbarui informasi profil Anda.</p>
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <!-- Input untuk Nama -->
                    <div class="col-md-2 mb-2">
                        <img id="profile-picture"
                            src="<?= user('photo') ?? '/assets/storage/default/default_profile.png' ?>"
                            alt="photo=<?= user('name') ?>" width="150px" class="rounded-circle">
                    </div>
                    <!-- Input untuk Email -->


                    <div class="col-md-10 ">

                        <label for="name">Nama</label>
                        <input required type="text" id="name" name="name" value="<?= htmlspecialchars(user('name')) ?>"
                            class="form-control">

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input required type="email" id="email" name="email"
                                    value="<?= htmlspecialchars(user('email')) ?>" class="form-control">

                            </div>
                            <div class="col-md-6">
                                <label for="photo">Ubah Foto Profile</label>
                                <input type="file" id="photo" name="photo" class="form-control">

                            </div>

                        </div>

                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" name="update_profile" class="btn btn-outline-dark">Edit Profile</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Card untuk Edit Password -->
    <div class="card mb-3 border-dark">

        <div class="card-header  bg-white  fw-bold">
            Edit Password
        </div>
        <div class="card-body">
            <p class="text-muted">Pastikan untuk memasukkan password yang kuat dan mudah diingat.</p>

            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="new_password">Password Baru</label>
                        <input required type="password" id="new_password" name="new_password" class="form-control">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input required type="password" id="confirm_password" name="confirm_password"
                            class="form-control">
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" name="edit_password" class="btn btn-outline-dark">Edit Password</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Card untuk Hapus Akun -->
    <div class="card mb-3 border border-danger">
        <div class="card-header bg-white text-danger fw-bold">
            Hapus Akun
        </div>
        <div class="card-body">
            <p class="text-danger">Menghapus akun akan menghapus semua data Anda secara permanen dari sistem.</p>


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                data-bs-target="#modalDeleteUser">
                Hapus akun
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalDeleteUser" data-bs-backdrop="static" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Yakin ingin hapus akun?</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <input placeholder="Masukan Password" type="password" name="password_confirm_delete"
                                        class="form-control" required>
                                </div>
                                <div class="d-flex justify-content-end">

                                    <button type="submit" name="delete-user" class="btn btn-danger ">
                                        Hapus akun
                                    </button>
                                </div>
                            </form>
                        </div>


                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div> -->

                    </div>
                </div>

            </div>
        </div>
    </div>