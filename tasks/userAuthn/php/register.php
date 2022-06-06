<?php
if(isset($_POST['submit'])){
    $username = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (registerUser($username, $email, $password)) {
        echo 'Successfully registered';
    } else {
        echo 'Registration failed!';
    }

}

function registerUser($username, $email, $password){
    $data = [
         $username, 
         $email, 
         $password
    ];

    $file = '../storage/users.csv';
    
    //save data into the file
    if ($handle = fopen($file, 'a')) {
        fputcsv($handle, $data);
        fclose($handle);
        return true; 
    } 
    return false;
}