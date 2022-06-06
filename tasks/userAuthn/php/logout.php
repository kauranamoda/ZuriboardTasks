<?php
session_start();

function logout(){
    if (isset($_SESSION['email'])) {
        unset($_SESSION['email']);
        session_destroy($_SESSION['email']);
        header("Location: ../forms/login.html");
        die;
    }
}

logout();