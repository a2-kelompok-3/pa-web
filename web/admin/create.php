<?php

require "../koneksi.php";

if( isset($_GET["tambah"]) ){

    $rasa = $_POST["rasa"];
    $stok = $_POST["stok"];

    $query = "INSERT INTO bakpia VALUES
                ('', '$rasa', '$stok')";
    mysqli_query($conn, $query);
    echo "<script>
            alert('Berhasil Menambahkan Data');
            document.location.href = '../admin/read.php';
          </script>";
}

?>

<html>
    <body>
        <h1>Tambah Data</h1>
        <form action="" method="get">
            Rasa:
            <input type="text" name="rasa">
            <br>
            Stok :
            <input type="text" name="stok">
            <br>
            <button type="submit" name="tambah">TAMBAH</button>
        </form>
    <footer>
      <p>Created by Kelompok 3 A2 | © 2023</p>
    </footer>
  </body>
</html>