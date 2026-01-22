<?php
include('config/constants.php');

// Enable exception handling
mysqli_report(MYSQLI_REPORT_OFF); // Disable auto-throw to handle manually or use try-catch everywhere. 
// Actually let's just use try-catch on the query.

$sql_content = file_get_contents('upgrade_v2.sql');
// rudimentary split by semicolon. Warning; this breaks if ; is inside quotes, but our SQL is simple.
$queries = explode(';', $sql_content);

echo "Starting Robust Upgrade...\n";

foreach ($queries as $key => $query) {
    $minimized = trim($query);
    if (empty($minimized)) continue;

    // Check if it's a comment
    if (strpos($minimized, '--') === 0 && strpos($minimized, "\n") === false) {
       continue; 
    }

    echo "Executing query #".($key+1)."...\n";
    try {
        if ($conn->query($minimized)) {
            echo "[SUCCESS] Query executed.\n";
        } else {
            echo "[ERROR] " . $conn->error . "\n";
            echo "Query: " . substr($minimized, 0, 100) . "...\n";
        }
    } catch (Exception $e) {
        echo "[EXCEPTION] " . $e->getMessage() . "\n";
        echo "Query: " . substr($minimized, 0, 100) . "...\n";
    }
}

echo "Upgrade Process Complete.\n";
?>
