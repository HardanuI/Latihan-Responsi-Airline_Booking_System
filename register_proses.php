<?php

    session_start();

include_once(__DIR__ . '/koneksi.php');
$namaLengkap = $_POST['namaLengkap'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$konfirmasiPassword = $_POST['konfirmasiPassword'];

if ($password !== $konfirmasiPassword) {
    header("Location: register_view.php?error=password salah");
    exit();
}

    try{

        $sql = "SELECT id_user FROM users WHERE email = ? LIMIT 1";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param('s',$email);
        if($stmt->execute()){
            $stmt->store_result();
            if($stmt->num_rows > 0){
                echo"if kedua";
                header("Location: register_view.php");
            exit();

            }
        }else{
            echo "ERROR : ".$stmt->error;
        }

    }catch(mysqli_sql_exception $e){
        echo "Error mysql : ".$e->getMessage();
    }
    $stmt->close();
    $role = 'user';


    try{

        $sql = "INSERT INTO users (nama_lengkap,username, email, password,role) VALUES (?,?,?,?,?)";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param('sssss',$namaLengkap,$username, $email, $password, $role);
        if($stmt->execute()){

            header("Location: login_view.php");
            exit();
        }else{
            echo "ERROR : ".$stmt->error;
        }

    }catch(mysqli_sql_exception $e){
        echo "Error mysql : ".$e->getMessage();
    }
    $stmt->close();
    $koneksi->close();
?>