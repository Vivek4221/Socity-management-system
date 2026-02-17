<?php
// Folder structure
if (!file_exists("uploads")) { mkdir("uploads", 0777, true); }

$files = [
    "config.php" => '<?php 
    $conn = mysqli_connect("localhost", "root", "", "society_db");
    if(!$conn) die("Connection Failed");
    date_default_timezone_set("Asia/Kolkata");
    ?>',

    "style.css" => '
    :root {
        --primary: #4361ee;
        --sidebar-bg: #1e1e2d;
        --accent: #00d2ff;
    }
    body { font-family: "Inter", sans-serif; background-color: #f4f7fe; margin: 0; }
    .sidebar { width: 260px; height: 100vh; background: var(--sidebar-bg); position: fixed; padding: 20px; color: #a2a3b7; }
    .sidebar-brand { font-size: 24px; font-weight: 800; color: white; margin-bottom: 40px; display: block; text-decoration: none; text-align: center; letter-spacing: 1px; }
    .nav-link { color: #a2a3b7; padding: 15px; border-radius: 12px; text-decoration: none; display: flex; align-items: center; margin-bottom: 10px; transition: 0.3s; }
    .nav-link:hover, .nav-link.active { background: rgba(255,255,255,0.1); color: white; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    .main-content { margin-left: 260px; padding: 40px; }
    .glass-card { background: white; border: none; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid rgba(255,255,255,0.8); }
    .stat-val { font-size: 32px; font-weight: 800; color: #2b2d42; }
    .btn-premium { background: linear-gradient(135deg, #4361ee, #3f37c9); color: white; border-radius: 12px; padding: 12px 25px; border: none; font-weight: 600; box-shadow: 0 10px 20px rgba(67, 97, 238, 0.2); transition: 0.3s; }
    .btn-premium:hover { transform: translateY(-3px); box-shadow: 0 15px 25px rgba(67, 97, 238, 0.3); color: white; }',

    "dashboard.php" => '<?php 
    include("config.php"); 
    session_start(); 
    if(!isset($_SESSION["user"])) header("location: index.php"); 
    
    // Yahan humne variable ko string ke bahar rakha hai taaki error na aaye
    $live_q = mysqli_query($conn, "SELECT id FROM visitors WHERE exit_time IS NULL");
    $live_count = mysqli_num_rows($live_q);
    
    $today_q = mysqli_query($conn, "SELECT id FROM visitors WHERE DATE(entry_time) = CURDATE()");
    $today_count = mysqli_num_rows($today_q);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>SECURE GATE | Builder Edition</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="sidebar">
            <a href="#" class="sidebar-brand"><i class="fas fa-shield-halved"></i> SECURE GATE</a>
            <a href="dashboard.php" class="nav-link active"><i class="fas fa-chart-pie me-3"></i> Overview</a>
            <a href="visitor_entry.php" class="nav-link"><i class="fas fa-user-plus me-3"></i> New Entry</a>
            <a href="visitor_list.php" class="nav-link"><i class="fas fa-clock-rotate-left me-3"></i> Live Status</a>
            <a href="visitor_history.php" class="nav-link"><i class="fas fa-file-export me-3"></i> Analytics</a>
            <a href="logout.php" class="nav-link text-danger mt-5"><i class="fas fa-power-off me-3"></i> Logout</a>
        </div>
        <div class="main-content">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 class="fw-bold text-dark">Prop-Tech Dashboard</h2>
                <div class="glass-card py-2 px-4 shadow-sm">
                    <span class="text-muted small fw-bold">SYSTEM ACTIVE</span>
                    <i class="fas fa-circle text-success ms-2 small"></i>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="glass-card">
                        <p class="text-muted mb-1 fw-bold small">CURRENT VISITORS</p>
                        <div class="stat-val"><?php echo $live_count; ?></div>
                        <div class="progress mt-3" style="height: 6px;"><div class="progress-bar bg-primary" style="width: 70%"></div></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card border-start border-primary border-4">
                        <p class="text-muted mb-1 fw-bold small">TODAY TOTAL</p>
                        <div class="stat-val"><?php echo $today_count; ?></div>
                        <div class="text-success small mt-2"><i class="fas fa-arrow-up me-1"></i> Increased Security</div>
                    </div>
                </div>
            </div>
            <div class="mt-5 glass-card">
                <div class="d-flex justify-content-between mb-4">
                    <h5 class="fw-bold">Security Log Stream</h5>
                    <a href="export_excel.php" class="btn btn-dark btn-sm rounded-pill px-3">Download Excel</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="text-muted small uppercase">
                            <tr><th>VISITOR</th><th>UNIT</th><th>CHECK-IN</th><th>STATUS</th></tr>
                        </thead>
                        <tbody>
                            <tr><td colspan="4" class="text-center py-5 text-muted">Data streaming live... Go to Live Status for management.</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    </html>',

    "logout.php" => "<?php session_start(); session_destroy(); header('location: index.php'); ?>",

    "export_excel.php" => '<?php
    include("config.php");
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=Gate_Report.xls");
    echo "Visitor\tPhone\tFlat\tIn\tOut\n";
    $res = mysqli_query($conn, "SELECT * FROM visitors");
    while($r = mysqli_fetch_assoc($res)) {
        echo "{$r[\'visitor_name\']}\t{$r[\'phone\']}\t{$r[\'flat_no\']}\t{$r[\'entry_time\']}\t{$r[\'exit_time\']}\n";
    }
    ?>'
];

foreach($files as $name => $content) { 
    file_put_contents($name, $content); 
    echo "⚡ Optimized: <b>$name</b><br>"; 
}
echo "<hr><h3>🚀 Dashboard Fixed! First Impression Ready.</h3>";
?>