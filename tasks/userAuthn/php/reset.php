<?php
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    resetPassword($email, $password);
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

function get_user_data($email) {
    $data = get_csv_data();
    foreach($data as $user) {
        if (in_array($email, $user)) {
            return $user; // user data is returned in order to be able to update it in the resetPassword()
        }
    }
    return false;
}

function resetPassword($email, $password){
    if (get_user_data($email)) { 

        $csvfile = '../storage/users.csv';

        $tempfile = tempnam("../storage", "tmp");
        $data = get_csv_data();
        $handle = fopen($tempfile, 'a'); 

        foreach($data as $value) {
            if (in_array($email, $value)) {
                $value[2] = $password;
            }
            fputcsv($handle, $value);
        }

        fclose($handle);

        unlink($csvfile);
        rename($tempfile, $csvfile);

        echo 'done';
        
    } else {
        echo 'User does not exist';
    }
}