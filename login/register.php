<?php
session_start();
include '../koneksi.php';

if (!empty($_POST)) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = 'user'; // set default role to user
  
  // Insert data user ke database
  $sql = "INSERT INTO user (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";
  if ($mysqli && mysqli_query($mysqli, $sql)) {
    $_SESSION['id'] = mysqli_insert_id($mysqli);
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $username;
    $_SESSION['role'] = $role;

    echo "<script>alert('Registrasi akun berhasil! Silahkan login')</script>";
    header('Location: index.php');
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-YgoqoWLtY3vBMbpQTq15omG3NkKjjkizXuw6yWw4Ua38iaVUZtVqp+i8n3os7tSrC7hawtG0UnRgWdsAZXJhqQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/login.css">
  <title>Register</title>
</head>
<body>
    <div class="input">
      <form method="POST">
        <h1>REGISTER</h1>
        <div class="box-input">
            <i class="fas fa-address-book"></i>
            <input type="text" placeholder="Username" name="username" required>
        </div>
        <div class="box-input">
            <i class="fas fa-address-book"></i>
            <input type="text" placeholder="Email" name="email" required>
        </div>
        <div class="box-input">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" required>
        </div>
        <button type="submit" name="register" class="btn-input">Register</button>
        <p>Sudah punya akun?
                <a href="index.php">Login disini</a>
            </p>
        </form>
        <div class="buttom">
            
        </div>
    </div>
</body>
</html>
