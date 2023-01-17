<?php
    session_start();
    include 'connection.php';

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $pswd = $_POST['password'];

        echo $q = "SELECT * from `users` where `email` = '$email' and `password` = '$pswd'";
        $res = mysqli_query($con, $q);
        
        $user = mysqli_fetch_assoc($res);
        // Authentication
        if(mysqli_num_rows($res) > 0){
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];

            // Authorization
            if($user['role'] == 'Admin'){
                header('location: admin/');
                die;
            }
            else if($user['role'] == 'User'){
                header('location: user/');
                die;
            } 
            else{
                header('location: index.php');
                die;
            }

        } else {
            echo 'login failed';
        }

    }

?>