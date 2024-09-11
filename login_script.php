<?php
session_start();
require_once 'condb.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_data = $conn->prepare("SELECT * FROM tb_users WHERE email =?");
    $check_data->bindParam(1, $email);
    $check_data->execute();
    $row = $check_data->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        if (password_verify($password, $row['password'])) {
                $_SESSION['role'] = $row['role'];
                $_SESSION['id'] = $row['id'];
                header("Location: index.php");
                exit; // Terminate script after redirection
            
        } else {
            $_SESSION['error'] = 'รหัสผ่านผิด';
            header("Location: login.php");
            exit; // Terminate script after redirection
        }
    } else {
        $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
        header("Location: login.php");
        exit; // Terminate script after redirection
    }
}
?>