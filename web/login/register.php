<?php
session_start();
include 'koneksi.php';

if (!empty($_POST)) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = 'user'; // set default role to user
  
  // Hash the password before saving to the database
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  
  // Insert new user data into the database
  $sql = "INSERT INTO user (username, email, password, role) VALUES ('$username', '$email', '$hashedPassword', '$role')";
  if ($conn && mysqli_query($conn, $sql)) {
    $_SESSION['id'] = mysqli_insert_id($conn);
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $username;
    $_SESSION['role'] = $role;
  
    header('Location: ../menu/');
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <title>Register</title>
</head>
<body>
    <div class="input">
        <h1>REGISTER</h1>
        <form method="POST">
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
        </form>
        <div class="buttom">
            <p>Sudah punya akun?
                <a href="index.php">Login disini</a>
            </p>
        </div>
    </div>
</body>

</html>
