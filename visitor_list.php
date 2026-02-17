<?php
include("config.php");
if(isset($_GET["exit"])) { $id=$_GET["exit"]; $t=date("Y-m-d H:i:s"); mysqli_query($conn, "UPDATE visitors SET exit_time='$t' WHERE id=$id"); }
?>
<!DOCTYPE html>
<html>
<head><title>List</title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></head>
<body><div class="container mt-5"><h3>Current Visitors</h3><table class="table table-striped mt-3">
<thead class="table-dark"><tr><th>Photo</th><th>Name</th><th>Flat</th><th>Action</th></tr></thead><tbody>
<?php $res = mysqli_query($conn, "SELECT * FROM visitors WHERE exit_time IS NULL");
while($r = mysqli_fetch_assoc($res)) { echo "<tr><td><img src='uploads/{$r['visitor_photo']}' width='50'></td><td>{$r['visitor_name']}</td><td>{$r['flat_no']}</td><td><a href='?exit={$r['id']}' class='btn btn-danger btn-sm'>Exit</a></td></tr>"; } ?>
</tbody></table><a href="dashboard.php" class="btn btn-secondary">Back</a></div></body></html>