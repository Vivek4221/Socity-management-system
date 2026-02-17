<?php 
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
    </html>