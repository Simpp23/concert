<?php 
    include "condb.php";

    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['name']) && isset($_POST['price']) && isset($_POST['uploadBy'])){
            $name = $_POST['name'];
            $price = $_POST['price'];
            $uploadBy = $_POST['uploadBy'];

            // $sql = "INSERT INTO $table (name, price, addBy) VALUES ('$name' , '$price' ,'$uploadBy' )";
            // $result = $conn->exec($sql); ธรรมดา

            // $sql = "INSERT INTO $table (concert_name, price, uploadBy) VALUES (:concert_name,:price,:uploadBy)";
            // $smt = $conn->prepare($sql); แบบ2

            $sql = "INSERT INTO $table (concert_name, price, uploadBy) VALUES (:concert_name,:price,:uploadBy)";
            $smt = $conn->prepare($sql);
            $smt->bindParam(":concert_name", $name);
            $smt->bindParam(":price", $price);
            $smt->bindParam(":uploadBy", $uploadBy); //prepare statement แบบ2

            $result = $smt->execute();
            //sweet alert
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            if ($result) {
                echo '<script>
                    setTimeout(function() {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "เพิ่มข้อมูลสําเร็จ",
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
            };
        }else{
          echo 'ตรวจสอบข้อมูลก่อนกดบันทึก';
        }

            
    }

    
?>