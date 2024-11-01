<?php
$name = "Dion Firmansyah";
$email = "yon@gmail.com";
$password_hash = password_hash('123123123', PASSWORD_DEFAULT);


$checkUser = "SELECT COUNT(*) as count FROM users WHERE email = '$email'";
$result = $DB->query($checkUser);
$userExists = $result->fetch_assoc()['count'] > 0;

if (!$userExists) {
    $createUser = "INSERT INTO users (name, email, password) 
                   VALUES ('$name', '$email', '$password_hash')";
    $DB->query($createUser);
}
