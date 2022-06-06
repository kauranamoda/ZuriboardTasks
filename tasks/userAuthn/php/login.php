<?php
session_start();

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    loginUser($email, $password);

}

function get_csv_data() {
    $file = file('../storage/users.csv');
    $data = [];
    foreach($file as $line) {
        $data[] = str_getcsv($line);
    }
    if ($data != NULL) {
        return $data;
    } else {
        return false;
    }
}


function user_exists($email, $password) {
    $data = get_csv_data();
    foreach($data as $user) {
        if (in_array($email, $user) && in_array($password, $user)) {
            return true;
        }
    }
    return false;
}



function loginUser($email, $password){   
    if (user_exists($email, $password)) {
        $_SESSION['email'] = $email;
        header("Location: ../dashboard.php");
        die;
    } else {
        header("Location: ../forms/login.html");
        die;
    }
}