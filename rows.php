<?php 
        require_once 'condb.php';
        
        $sql = "SELECT * FROM tb_users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(["id"=>$_SESSION['id']]);
        $user =  $stmt->fetch(PDO::FETCH_ASSOC);
   
    