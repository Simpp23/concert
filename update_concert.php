<?php
include('header.php');
include('footer.php');

include 'condb.php';

$id = $_POST['concert_id'];
$sql = "SELECT * FROM tb_concert_tickets WHERE concert_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $id);
$stmt->execute();
$concert = $stmt->fetch(PDO::FETCH_ASSOC);

$id = $concert['concert_id'];
$name = $concert['concert_name'];
$price = $concert['price'];
$uploadBy = $concert['uploadBy'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>concert</title>
</head>
<body>
    <div class="container">
        <h3 class="mt-4">แก้ไขข้อมูลบัตรคอนเสิร์ต</h3>
        <hr>
        <form action="update_concert_script.php" method="post">
            <input type="hidden" value="<?php echo $id ?>" name="concert_id" >
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อคอนเสิร์ต</label>
                <input type="text" class="form-control" placeholder="กรอกชื่อคอนเสิร์ต" value="<?php echo $name  ?>" name="name" id="name" aria-describedby="concert_name">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">ราคา</label>
                <input type="text" placeholder="กรอกราคาบัตรคอนเสิร์ต" class="form-control" value="<?php echo $price  ?>" name="price" id="price" aria-describedby="price">
            </div>
            <div class="mb-3">
                <label for="num_teacher" class="form-label">อัปโหลดข้อมูล</label>
                <input type="text" placeholder="กรอกชื่อผู้อัปโหลดข้อมูล" class="form-control" value="<?php echo $uploadBy  ?>" name="uploadBy" id="uploadBy" aria-describedby="uploadBy">
            </div>
            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
        </form>
        <hr>
        <p class="text-end">
            <a class='btn' href="index.php">กลับหน้าหลัก</a>
        </p>
    </div>
</body>

</html>