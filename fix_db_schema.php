<?php
include('config/constants.php');
mysqli_report(MYSQLI_REPORT_OFF);

$queries = [
    "ALTER TABLE tbl_order ADD COLUMN restaurant_id int(10) unsigned DEFAULT 0", 
    "ALTER TABLE tbl_order ADD COLUMN rider_id int(10) unsigned DEFAULT 0",
    "ALTER TABLE tbl_order ADD COLUMN delivery_fee decimal(10,2) DEFAULT 0.00",
    "ALTER TABLE tbl_order ADD COLUMN delivery_instruction text",
    "ALTER TABLE tbl_order ADD COLUMN delivery_lat decimal(10,8)",
    "ALTER TABLE tbl_order ADD COLUMN delivery_long decimal(11,8)",
    "ALTER TABLE tbl_order ADD COLUMN payment_method varchar(50) DEFAULT 'COD'",
    "ALTER TABLE tbl_order ADD COLUMN payment_status varchar(50) DEFAULT 'Pending'",
    "ALTER TABLE tbl_order MODIFY COLUMN status varchar(50) DEFAULT 'Ordered'"
];

echo "Fixing tbl_order...\n";

foreach($queries as $q) {
    if($conn->query($q)) {
        echo "[SUCCESS] " . substr($q, 0, 40) . "...\n";
    } else {
        // If error is "Duplicate column name", that's fine.
        if($conn->errno == 1060) {
            echo "[msg] Column already exists.\n";
        } else {
            echo "[ERROR] " . $conn->error . "\n";
        }
    }
}

// Also ensure tbl_restaurant exists just in case
$q_rest = "CREATE TABLE IF NOT EXISTS `tbl_restaurant` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `email` varchar(150),
  `phone` varchar(20),
  `address` text,
  `image_name` varchar(255),
  `password` varchar(255) NOT NULL,
  `opening_hours` varchar(100),
  `delivery_radius_km` decimal(10,2) DEFAULT 10.00,
  `rating` decimal(3,2) DEFAULT 0.00,
  `active` varchar(10) DEFAULT 'Yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if($conn->query($q_rest)) echo "[CHECK] tbl_restaurant ensured.\n";

echo "Done.\n";
?>
