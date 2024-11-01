<?php


function uploadFile($file)
{
    // Tentukan folder tujuan
    $targetDir = "assets/storage/";

    // die(var_dump($targetDir));
    // Ambil nama file dan tambahkan timestamp untuk menghindari duplikat
    $targetFile = $targetDir . time() . "_" . basename($file["name"]);
    $uploadOk = true;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Periksa apakah file adalah gambar
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        Toast("File bukan gambar.", 'info');
        redirectTo(getURI());

        $uploadOk = false;
    }

    // Batasi tipe file yang diizinkan
    $allowedTypes = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($fileType, $allowedTypes)) {
        Toast("Hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan.", "info");
        redirectTo(getURI());

        $uploadOk = false;
    }

    // Periksa ukuran file (contoh batas 2MB)
    if ($file["size"] > 2000000) {
        echo "";
        Toast("Ukuran file terlalu besar.", 'info');
        redirectTo(getURI());

        $uploadOk = false;
    }

    // Proses upload jika lolos semua validasi
    if ($uploadOk) {
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            Toast("File " . htmlspecialchars(basename($file["name"])) . " berhasil diupload.", 'success');
            redirectTo(getURI());
            return $targetFile;
        } else {
            Toast("Terjadi kesalahan saat mengupload file.", 'danger');
            redirectTo(getURI());

        }
    }
    return false;
}