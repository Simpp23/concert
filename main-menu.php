    <?php include "rows.php"; ?>
    <!-- Content -->
    <div class="container mt-3 m-border text-center">
        <h2>Welcome : <?php echo $user['fname']." ".$user['iname'] ?></h2>
        <div class="d-grid gap-2">

            <a href="insertDataIndex.php" class="btn btn-success">Concert Tickets</a>
            <a href="hw07_showData.php" class="btn btn-info">Show Concert Tickets Records</a>
            <a href="show_th.php" class="btn btn-warning">Show Thai Concert</a>
            <a href="show_user.php" class="btn btn-primary">Show table user</a>
            <a href="show_admin.php" class="btn btn-danger">Show Admin</a>
            <!-- <a href="" class="btn btn-primary">Insert Data with SQL by Prepared Statement=> ?</a>
            <a href="" class="btn btn-primary">Insert Data with Form by PDO</a>
            <a href="" class="btn btn-primary">View Student Data</a> -->
        </div>
    </div>
    
    <!-- End Content -->