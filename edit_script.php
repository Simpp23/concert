<?php
    include "condb.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        $sql = "UPDATE tb_users SET fname = ?,iname = ?, email = ? , role = ? WHERE id = ? ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $fname);
        $stmt->bindParam(2, $lname);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $role);
        $stmt->bindParam(5, $id);
    
        $result = $stmt->execute();
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        if ($result) {
            echo '<script>
                        setTimeout(function() {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "อัพเดตข้อมูลสําเร็จ",
                                showConfirmButton: true,
                                // timer: 1500
                            }).then(function() {
                            window.location = "index.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
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
                        showConfirmButton: true,
                        // timer: 1500
                        }).then(function() {
                    window.location = "index.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                        });
                    }, 1000);
                </script>';
        }
    }


?>