<?php 
session_start();
include 'include/koneksi.php';
if(isset($_POST['login'])) {
    $email=$_POST['email'];
    $password=$_POST['password'];

    global $conn;
    $stmt =$conn->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
    $stmt->bind_param('si', $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
    if($result->num_rows == 1) {
        $_SESSION['admin'] = $admin;
        header('location: http://localhost/lspdhani/dashboard.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/lspdhani/bootstrap1/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="card p-5 col-5 mt-3 m-auto">
        <h1 class="text-center">LOGIN</h1>
        <form action="login.php"method="post">
            <div class="mt-2 form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="email">
                <label for="email" class="form-label">email</label>
            </div>
             <div class="mt-2 form-floating">
                <input type="password" class="form-control" id="passwprd" name="password" placeholder="password">
                <label for="password" class="form-label">password</label>
            </div>
            <button name="login"type="submit" class="btn btn-primary mt-2 col-12">login</button>
        </form>
    </div>
</body>
</html>