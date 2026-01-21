<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Reports / Sales Analytics</h1>
        <br><br>

        <div class="col-4 text-center">
            <?php 
                // 1. Total Sales (Delivered only)
                $sql = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($res);
                $total_revenue = $row['Total'];
            ?>
            <h1>$<?php echo round((float)$total_revenue, 2); ?></h1>
            <br />
            Total Revenue (Delivered)
        </div>

        <div class="col-4 text-center">
            <?php 
                // 2. Total Orders
                $sql2 = "SELECT COUNT(*) AS Total FROM tbl_order";
                $res2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($res2);
                $total_orders = $row2['Total'];
            ?>
            <h1><?php echo $total_orders; ?></h1>
            <br />
            Total Orders
        </div>

        <div class="col-4 text-center">
            <?php 
                // 3. Pending Orders
                $sql3 = "SELECT COUNT(*) AS Total FROM tbl_order WHERE status='Ordered' OR status='Pending'";
                $res3 = mysqli_query($conn, $sql3);
                $row3 = mysqli_fetch_assoc($res3);
                $pending_orders = $row3['Total'];
            ?>
            <h1><?php echo $pending_orders; ?></h1>
            <br />
            Pending Orders
        </div>

        <div class="clearfix"></div>
        <br><br>

        <h2>Order Status Breakdown</h2>
        <br>
        
        <table class="tbl-full">
            <tr>
                <th>Status</th>
                <th>Count</th>
                <th>Revenue Potential</th>
            </tr>
            <?php 
                $sql_status = "SELECT status, COUNT(*) as count, SUM(total) as revenue FROM tbl_order GROUP BY status";
                $res_status = mysqli_query($conn, $sql_status);
                while($row_status = mysqli_fetch_assoc($res_status)) {
                    echo "<tr>";
                    echo "<td>" . $row_status['status'] . "</td>";
                    echo "<td>" . $row_status['count'] . "</td>";
                    echo "<td>$" . number_format($row_status['revenue'], 2) . "</td>";
                    echo "</tr>";
                }
            ?>
        </table>

    </div>
</div>

<?php include('partials/footer.php'); ?>
