<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $phone = $_POST["phone"];
    $role = $_POST["role"];

    try{
        require_once "dbh.inc.php";

        $query ="INSERT INTO users (full_name, email, pwd, phone, role) VALUES (?,?,?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$full_name, $email, $pwd, $phone, $role]);
        $stmt = null;//to free up the memmory
        $pdo = null;
        header("Location: ../login.php");
        die();

    }catch(PDOException $e){
        die('Query Failed' . $e->getMessage());
    }

}
else{
    header("Location: ../index.php");
}