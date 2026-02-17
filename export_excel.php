<?php
    include("config.php");
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=Gate_Report.xls");
    echo "Visitor\tPhone\tFlat\tIn\tOut\n";
    $res = mysqli_query($conn, "SELECT * FROM visitors");
    while($r = mysqli_fetch_assoc($res)) {
        echo "{$r['visitor_name']}\t{$r['phone']}\t{$r['flat_no']}\t{$r['entry_time']}\t{$r['exit_time']}\n";
    }
    ?>