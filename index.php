<?php
include("config.php");
session_start();
if(isset($_POST["login"])) {
    $u = $_POST["username"]; $p = md5($_POST["password"]);
    $res = mysqli_query($conn, "SELECT * FROM users WHERE username='$u' AND password='$p'");
    if(mysqli_num_rows($res) > 0) { $_SESSION["user"] = $u; header("location: dashboard.php"); }
    else { $error = "Invalid Login Details"; }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></head>
<body class="bg-dark text-white">
<div class="container mt-5"><div class="row justify-content-center"><div class="col-md-4 card p-4 text-dark shadow-lg">
<h2 class="text-center">Society Login</h2>
<form method="POST"><input type="text" name="username" class="form-control mb-3" placeholder="Username" required>
<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
<button name="login" class="btn btn-primary w-100">Login</button></form>
</div></div></div></body></html>