<?php
require_once 'condb.php';
include 'header.php';
include 'footer.php';
$sql = "SELECT * FROM $table WHERE country = :country";
$stmt = $conn->prepare($sql);
$stmt->execute(['country'=>'ไทย']);
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
</head>

<body>
    <div class="container">
        <h1>Concert Tickets Record</h1>
        <table class="table" id="userTable">
            <thead>
                <tr>
                    <th>id tickets</th>
                    <th>ชื่อคอนเสิร์ต</th>
                    <th>ราคาบัตร</th>
                    <th style='text-align:center;'>ประเทศ</th>
                    <th>เพิ่มข้อมูลโดย</th>
                    <th>วันที่ลงข้อมูล</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            foreach ($tickets as $ticket) {
                echo "<tbody><tr>
                    <td style='text-align:center;'>" . $ticket['concert_id'] . "</td>
                    <td>" . $ticket['concert_name'] . "</td>
                    <td style='text-align:center;'>" . $ticket['price'] . "</td>
                    <td style='text-align:center;'>" . $ticket['country'] . "</td>
                    <td>" . $ticket['uploadBy'] . "</td>
                    <td style='text-align:center;'>" . $ticket['reg_date'] . "</td>
                    ";

                ?>
                <td>
                        
                        <form action="update_concert.php" method="POST" style="display:inline;">
                            <input type="hidden" name="concert_id" value="<?php echo $ticket['concert_id']; ?>">
                            <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                        </form>
                        <form action="delete_script.php" method="POST" style="display:inline;">
                            <input type="hidden" name="concert_id" value="<?php echo $ticket['concert_id']; ?>">
                            <!-- <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm"> -->
                            <button type="button" class="btn btn-danger btn-sm delete-button"
                                data-user-id="<?php echo $ticket['concert_id']; ?>">Delete</button>
                        </form>


                    </td>

                </tr>
                </tbody>
                <?php
            };
            ?>
        </table>
        <div>
            <a class="btn btn-secondary" href="index.php">ย้อนกลับไปหน้าหลัก</a>
        </div>
    </div>
    <script src='https://code.jquery.com/jquery-3.7.1.min.js'></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#userTable');
    </script>
    <script>
// ฟังก์ชันสาหรับแสดงกล่องยืนยัน ํ SweetAlert2
function showDeleteConfirmation(userId) {
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่?',
        text: 'คุณจะไม่สามารถเรียกคืนข ้อมูลกลับได ้!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ลบ',
        cancelButtonText: 'ยกเลิก',
    }).then((result) => {
        if (result.isConfirmed) {
            // หากผู้ใชยืนยัน ให ้ส ้ งค่าฟอร์มไปยัง ่ delete.php เพื่อลบข ้อมูล
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'delete_script.php';
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'concert_id';
            input.value = userId;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
// แนบตัวตรวจจับเหตุการณ์คลิกกับองค์ปุ่ มลบทั้งหมดที่มีคลาส delete-button
const deleteButtons = document.querySelectorAll('.delete-button');
deleteButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const userId = button.getAttribute('data-user-id');
        showDeleteConfirmation(userId);
    });
});
</script>
</body>
</html>