<?php
$hash = ' $2y$10$ZArUlsahPEWl2i8SLgFwmuJ2bG1B4A5X8MzG5zvlIHiHioVNpYgcq';
$password = 'admin123';

if (password_verify($password, $hash)) {
    echo "Password cocok, login berhasil";
} else {
    echo "Password salah";
}
?>
