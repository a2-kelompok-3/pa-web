<?php
session_start();
include '../koneksi.php';

// check if the connection is successful
if (!$mysqli) {
  die("Connection failed: " . mysqli_connect_error());
}

// query to retrieve data from database
$query = "SELECT * FROM product";
$result = mysqli_query($mysqli, $query);


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
  <link href="../css_admin/read.css" rel="stylesheet">
</head>

  <body>
  <nav id="navbar" class="navbar">
        <ul>
          <li><a href="beranda_admin.php">Home</a></li>
          <li><a href="../logout.php">logout</a></li>
        </ul>
      </nav><!-- .navbar -->

      <h1>Halaman Utama</h1>
      <a href="../admin/create.php">Tambah</a>

      <div class="container">
      <table border="1" cellpadding="10" cellspacing="0">
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Deskripsi</th>
            <th>bahan</th>
          </tr>
          <?php
          while( $row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row["id"] ?></td>
            <td><?php echo $row["name"] ?></td>
            <td><?php echo $row["price"] ?></td>
            <td><img src="<?php echo $row["image"] ?>" width="100"></td>
            <td><?php echo $row["description"] ?></td>
            <td><?php echo $row["content"] ?></td>
            <td>
              <a href="../admin/update.php?id=<?php echo $row["id"] ?>">Ubah</a>
              <a href="../admin/delete.php?id=<?php echo $row["id"] ?>">Hapus</a>
            </td>
          </tr>
          <?php } ?>
      </table>
      </div>

    <footer>
      <p>Created by Kelompok 3 A2 | © 2023</p>
    </footer>
  </body>  
</html>

<?php
// close database connection
mysqli_close($mysqli);
?>
