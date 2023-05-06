<?php

require "../koneksi.php";
$id = $_GET["id"];

$query = "SELECT * FROM bakpia WHERE id = '$id'";
$result = mysqli_query($conn,$query);

if( !isset($_GET["id"]) ){
    header("Location: ../admin/read.php");
    exit;
}else if( mysqli_num_rows( $result ) == 1 ){

}else{
    header("Location: ../admin/read.php");
    exit;
}

function ubah($data){
    global $conn;
    $id = $_POST["id"];
    $rasa = $_POST["rasa"];
    $stok = $_POST["stok"];

    $query = "UPDATE bakpia SET
                rasa = '$rasa',
                stok = '$stok',
                WHERE id = '$id'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

if( isset($_POST["update"]) ){
    if( ubah($_POST) > 0 ){
        echo "<script>
                alert('Berhasil Mengubah Data');
                document.location.href = '../admin/read.php';
                </script>";
    }else{
    echo "<script>
            alert('Gagal Mengubah Data');
            </script>";
    }
}
?>

<html>
    <body>
        <h1>Halaman Update</h1>
        <form action="" method="post">
            <?php while( $row = mysqli_fetch_assoc($result)) {?>
            <input type="hidden" name="id" value="<?php echo $row['id']?>">
            Rasa :
            <input type="text" name="rasa" value="<?php echo $row['rasa']?>">
            <br>
            Stok
            <input type="text" name="stok" value="<?php echo $row['stok']?>">
            <br>
            <button type="submit" name="update">UPDATE</button>
            <?php } ?>
        </form>
        <footer>
      <p>Created by Kelompok 3 A2 | © 2023</p>
    </footer>
  </body>
</html>