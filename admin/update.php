<?php
session_start();
require "../koneksi.php";

$id = $_GET["id"];

$query = "SELECT * FROM product WHERE id = '$id'";
$result = mysqli_query($mysqli, $query);

if( !isset($_GET["id"]) ){
    header("Location: ../admin/read.php");
    exit;
}else if( mysqli_num_rows( $result ) == 1 ){

}else{
    header("Location: ../admin/read.php");
    exit;
}

function updateProduct($id, $name, $price, $image, $description, $content){
    global $mysqli;

    $query = "UPDATE product SET 
                name = '$name', 
                price = '$price', 
                image = '$image', 
                description = '$description', 
                content = '$content' 
                WHERE id = '$id'";
    mysqli_query($mysqli, $query);
    return mysqli_affected_rows($mysqli);
}

if( isset($_POST["update"]) ){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $image = $_POST["image"];
    $description = $_POST["description"];
    $content = $_POST["content"];

    if( updateProduct($id, $name, $price, $image, $description, $content) > 0 ){
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
            Nama :
            <input type="text" name="name" value="<?php echo $row['name']?>">
            <br>
            Harga :
            <input type="text" name="price" value="<?php echo $row['price']?>">
            <br>
            Gambar :
            <input type="text" name="image" value="<?php echo $row['image']?>">
            <br>
            Deskripsi :
            <textarea name="description"><?php echo $row['description']?></textarea>
            <br>
            Bahan :
            <textarea name="content"><?php echo $row['content']?></textarea>
            <br>
            <button type="submit" name="update">UPDATE</button>
            <?php } ?>
        </form>
        <footer>
            <p>Created by Kelompok 3 A2 | © 2023</p>
        </footer>
    </body>
</html>
