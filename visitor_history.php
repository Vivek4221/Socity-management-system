<?php
include("config.php");
$sql = "SELECT * FROM visitors ORDER BY entry_time DESC";
if(isset($_GET["q"])) { $q = $_GET["q"]; $sql = "SELECT * FROM visitors WHERE flat_no LIKE '%$q%' OR visitor_name LIKE '%$q%' ORDER BY entry_time DESC"; }
?>
<!DOCTYPE html>
<html>
<head><title>History</title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></head>
<body><div class="container mt-5"><h3>Visitor History</h3>
<form method="GET" class="mb-3"><input type="text" name="q" placeholder="Search Flat/Name" class="form-control w-25 d-inline"> <button class="btn btn-primary">Search</button></form>
<table class="table table-bordered"><thead><tr><th>Name</th><th>Flat</th><th>Entry</th><th>Exit</th></tr></thead><tbody>
<?php $res = mysqli_query($conn, $sql); while($r = mysqli_fetch_assoc($res)) { echo "<tr><td>{$r['visitor_name']}</td><td>{$r['flat_no']}</td><td>{$r['entry_time']}</td><td>{$r['exit_time']}</td></tr>"; } ?>
</tbody></table><a href="dashboard.php">Back</a></div></body></html>