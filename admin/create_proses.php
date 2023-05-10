<?php
session_start();
include "../koneksi.php";

$nama = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];

$rand = rand();
$ekstensi =  array('jpg', 'jpeg');
$filename = $_FILES['image']['name'];
$ukuran = $_FILES['image']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if (!in_array($ext, $ekstensi)) {
    header("location:create.php?alert=gagal_ekstensi");
} else {
    if ($ukuran < 1044070) {
        $xx = $rand . '_' . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], '../foto/' . $rand . '_' . $filename);
        mysqli_query($mysqli, "INSERT INTO product VALUES(NULL,'$nama','$price','$xx','$description')");
        header("location:read.php?alert=berhasil");
    } else {
        header("location:create.php?alert=gagal_ukuran");
    }
}
