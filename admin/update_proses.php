<?php
session_start();
include "../koneksi.php";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];

    if (empty($image)) {
        $update = mysqli_query($mysqli, "UPDATE product SET name = '$nama', price = '$price', description = '$description'
        WHERE id = $id");
        if ($update) {
            header("location:read.php?alert=berhasil");
        } else {
            header("location:update.php?alert=gagal");
        }
    } else {
        $rand = rand();
        $ekstensi =  array('jpg', 'jpeg');
        $filename = $_FILES['image']['name'];
        $ukuran = $_FILES['image']['size'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (!in_array($ext, $ekstensi)) {
            header("location:update.php?alert=File Tidak Boleh");
        } else {
            if ($ukuran < 522035) {

                $xx = $rand . '_' . $filename;
                $lihat = mysqli_query($mysqli, "SELECT * FROM product WHERE id = $id");
                $row = mysqli_fetch_array($lihat);

                unlink("../foto/" . $row['image']);
                move_uploaded_file($_FILES['image']['tmp_name'], '../foto/' . $rand . '_' . $filename);
                mysqli_query($mysqli, "UPDATE product SET name = '$nama', price = '$price', image = '$xx',
                description = '$description' WHERE id = $id");
                // mysqli_query($mysqli, "INSERT INTO tb_dokumen(judul,keterangan,tanggal_up,file) VALUES('$judul',
                // '$keterangan','$tanggal,'$xx')");

                header("location:read.php?alert=Diubah");
            } else {
                header("location:update.php?alert=Ukuran Gagal");
            }
        }
    }
}