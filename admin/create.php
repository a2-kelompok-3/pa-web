<?php
session_start();
require "../koneksi.php";

if(isset($_POST['submit'])) {

    // get input values
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $description = $_POST['description'];
    $content = $_POST['content'];

    // image upload directory
    $target_dir = "../images/";

    // generate unique image name
    $image_name = time() . '_' . basename($image);

    // move uploaded file to image directory
    $target_file = $target_dir . $image_name;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // insert data into database
    $query = "INSERT INTO product (name, price, image, description, content) VALUES ('$name', '$price', '$image_name', '$description', '$content')";
    $result = mysqli_query($mysqli, $query);

    if($result) {
        echo "<script>
                alert('Berhasil Menambahkan Data');
                window.location.href = '../admin/read.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($mysqli);
require "../koneksi.php";

if(isset($_POST["create"])){
    $rasa = $_POST["rasa"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];

    $query = "INSERT INTO bakpia (rasa, harga, stok) 
              VALUES ('$rasa', '$harga', '$stok')";
    if(mysqli_query($conn, $query)){
        echo "<script>
                alert('Berhasil Menambahkan Data');
                document.location.href = '../admin/read.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Read Page</title>
  <link href="../assets/css/main.css" rel="stylesheet">
  <link href="../css_admin/create.css" rel="stylesheet">
</head>

    <body>
    <nav id="navbar" class="navbar">
        <ul>
          <li><a href="read.php">Home</a></li>
          <li><a href="../logout.php">logout</a></li>
        </ul>
      </nav><!-- .navbar -->

        <h1>Tambah Data</h1>
        <form action="" method="post" enctype="multipart/form-data">
            Name:
            <input type="text" name="name">
            <br>
            Harga :
            <input type="number" name="price">
            <br>
            Foto :
            <input type="file" name="image">
            <br>
            Deskripsi :
            <textarea name="description"></textarea>
            <br>
            Bahan :
            <textarea name="content"></textarea>
            <br>
            <button type="submit" name="submit">TAMBAH</button>
        </form>
        <footer>
          <p>Created by Kelompok 3 A2 | © 2023</p>
        </footer>
    </body>
</html>
    <body>
        <h1>Tambah Data</h1>
        <form action="" method="post">
            Rasa:
            <input type="text" name="rasa">
            <br>
            Harga :
            <input type="text" name="harga">
            <br>
            Stok :
            <input type="text" name="stok">
            <br>
            <button type="submit" name="create">TAMBAH</button>
        </form>
        <footer>
            <p>Created by Kelompok 3 A2 | © 2023</p>
        </footer>
    </body>
</html>
