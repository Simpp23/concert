<?php
// include('header.php');
// include('footer.php');
include 'condb.php';
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['uploadBy'])) {
    $id = $_POST['concert_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $uploadBy = $_POST['uploadBy'];

    $sql = "UPDATE $table SET concert_name = ?, price = ?, uploadBy = ? WHERE concert_id=? ";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $price);
    $stmt->bindParam(3, $uploadBy);
    $stmt->bindParam(4, $id);

    $result = $stmt->execute();

    //sweet alert
    
    if ($result) {
        echo '<script>
            setTimeout(function() {
            Swal.fire({
            position: "center",
            icon: "success",
            title: "อัพเดตข้อมูลสําเร็จ",
            showConfirmButton: false,
             timer: 1500
            }).then(function() {
            window.location = "hw07_showData.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
            });
            }, 1000);
            </script>';
    } else {
        echo '<script>
            setTimeout(function() {
            Swal.fire({
            position: "center",
            icon: "error",
            title: "เกิดข้อผิดพลาด",
            showConfirmButton: false,
             timer: 1500
            }).then(function() {
            window.location = "hw07_showData.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
            });
            }, 1000);
</script>';
    }
}else{
    echo '<script>
    setTimeout(function() {
    Swal.fire({
    position: "center",
    icon: "error",
    title: "ข้อมูลส่งมาไม่ครบ",
    showConfirmButton: false,
     timer: 1500
    }).then(function() {
    window.location = "hw07_showData.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
    });
    }, 1000);
</script>';
}


?>