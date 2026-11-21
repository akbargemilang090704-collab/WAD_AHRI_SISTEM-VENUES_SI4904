<?php

$koneksi = mysqli_connect("localhost", "root", "", "sistem_venue");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?>