<?php

define("SERVER", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");

$database = "starter_db";


try {
    $DB = new mysqli(SERVER, USERNAME, PASSWORD);


    if ($DB->connect_error) {
        die("Koneksi Gagal: " . $DB->connect_error);
    }

    $createDatabase = "CREATE DATABASE IF NOT EXISTS {$database}";

    $DB->query($createDatabase);


    $DB->select_db($database);
} catch (Exception $e) {
    die("Koneksi Gagl" . $e->getMessage());
}


include("migration.php");

include("seeder.php");

