<?php
$message = null;

if (isset($_POST["login"]) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Gunakan prepared statement untuk keamanan
    $stmt = $DB->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password hash
        if (password_verify($password, $user['password'])) {
            unset($user['password']); // Hapus password dari array untuk keamanan

            // Set session setelah login berhasil
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["users"] = $user;
        } else {
            Toast("Gagal Login: Password tidak valid.", 'danger');
        }
    } else {
        Toast("Gagal Login: Email tidak ditemukan.", 'danger');
    }
    $stmt->close();
}

if (isset($_POST["register"]) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Periksa jika email sudah terdaftar
    $stmt = $DB->prepare("SELECT COUNT(*) as count FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count == 0) {
        // Enkripsi password dengan password_hash
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert user baru menggunakan prepared statement
        $stmt = $DB->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password_hash);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Set session jika pendaftaran berhasil
            $_SESSION["user_id"] = $stmt->insert_id;
            $_SESSION["users"] = [
                'id' => $stmt->insert_id,
                'name' => $name,
                'email' => $email
            ];
            $message = "Akun berhasil dibuat.";
            Toast($message, 'success');
        } else {
            $message = "Gagal membuat akun. Silakan coba lagi.";
            Toast($message, 'danger');

        }
        $stmt->close();
    } else {
        $message = "Email sudah terdaftar.";
        Toast($message, 'danger');

    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: /home");
    exit;
}
?>