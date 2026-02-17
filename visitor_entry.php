<?php
include("config.php");
if(isset($_POST["save"])) {
    $img = "no-image.jpg";
    if(!empty($_FILES["photo"]["name"])) { $img = time()."_".$_FILES["photo"]["name"]; move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/".$img); }
    $n = $_POST["name"]; $f = $_POST["flat"]; $p = $_POST["phone"]; $pur = $_POST["purpose"];
    mysqli_query($conn, "INSERT INTO visitors (visitor_name, phone, flat_no, purpose, visitor_photo) VALUES ('$n','$p','$f','$pur','$img')");
    header("location: visitor_list.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Entry</title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></head>
<body class="bg-light"><div class="container mt-5"><div class="card p-4 mx-auto shadow" style="max-width:500px;">
<h3>Visitor Entry</h3><form method="POST" enctype="multipart/form-data">
<input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
<input type="text" name="phone" class="form-control mb-2" placeholder="Phone" required>
<input type="text" name="flat" class="form-control mb-2" placeholder="Flat No" required>
<input type="text" name="purpose" class="form-control mb-2" placeholder="Purpose">
<input type="file" name="photo" class="form-control mb-3" capture="camera" accept="image/*">
<button name="save" class="btn btn-success w-100">Save</button></form></div></div></body></html>