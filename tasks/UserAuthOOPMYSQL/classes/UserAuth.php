<?php
include_once 'Dbh.php';
session_start();

class UserAuth extends Dbh{
    protected $db;

    public function __construct(){
        $this->db = new Dbh(); 
    }

    public function confirmPasswordMatch($password, $confirmPassword){
        if($password === $confirmPassword){
            return true;
        } else {
            return false;
        }
    }

    public function checkEmailExist($email) {
        $conn = $this->db->connect();

        $query = "SELECT email FROM students WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        
        return ($result) ? true : false;
        $stmt->close();
    }

    public function register($fullname, $email, $password, $confirmPassword, $country, $gender){
        $conn = $this->db->connect();
        if($this->confirmPasswordMatch($password, $confirmPassword)){
            if ($this->checkEmailExist($email)) {
               echo 'email already registered, try another';
            } else {
                $sql = "INSERT INTO Students (`full_name`, `email`, `password`, `country`, `gender`) VALUES ('$fullname','$email', '$password', '$country', '$gender')";
                if($conn->query($sql)){
                echo "Ok";
                } else {
                    echo "Opps". $conn->error;
                }
            }
        } else {
            echo "Wrong password combination";
        }

        
    }

    public function login($email, $password){
        $conn = $this->db->connect();
        $sql = "SELECT * FROM Students WHERE email='$email' AND `password`='$password'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $_SESSION['email'] = $email;
            header("Location: dashboard.php");
        } else {
            header("Location: forms/login.php");
        }
    }


    public function updateUser($email, $password){
        if ($this->checkEmailExist($email)) {
            $conn = $this->db->connect();
            $query = "UPDATE students SET password = ? WHERE email = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $password, $email);
            $stmt->execute();

            // header("Location: dashboard.php?update=success"); // works locally
            header("Location: ../dashboard.php?update=success");
        } else {
            header("Location: forms/resetpassword.php?error=1");
        }
    }

    public function deleteUser($id){
        $conn = $this->db->connect();
        $sql = "DELETE FROM Students WHERE id = '$id'";
        if($conn->query($sql) === TRUE){
            header("Location: dashboard.php");
        } else {
            header("refresh:0.5; url=action.php?all=?message=Error");
        }
    }

    public function getAllUsers(){
        $conn = $this->db->connect();
        $sql = "SELECT * FROM Students";
        $result = $conn->query($sql);
        echo"<html>
        <head>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
        </head>
        <body>
        <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
        <table class='table table-bordered' border='0.5' style='width: 80%; background-color: smoke; border-style: none'; >
        <tr style='height: 40px'>
            <thead class='thead-dark'> <th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th>
        </thead></tr>";
        if($result->num_rows > 0){
            while($data = mysqli_fetch_assoc($result)){
                //show data
                echo "<tr style='height: 20px'>".
                    "<td style='width: 50px; background: gray'>" . $data['id'] . "</td>
                    <td style='width: 150px'>" . $data['full_name'] .
                    "</td> <td style='width: 150px'>" . $data['email'] .
                    "</td> <td style='width: 150px'>" . $data['gender'] . 
                    "</td> <td style='width: 150px'>" . $data['country'] . 
                    "</td>
                    <td style='width: 150px'> 
                    <form action='action.php' method='post'>
                    <input type='hidden' name='id'" .
                     "value=" . $data['id'] . ">".
                    "<button class='btn btn-danger' type='submit', name='delete'> DELETE </button> </form> </td>".
                    "</tr>";
            }
            echo "</table></table></center></body></html>";
        }
    }

    public function logout($email){
        session_start();
        session_destroy();
        header("Location: index.php");
    }


    public function getUser($email){
        $conn = $this->db->connect();
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }


    public function getUserByUsername($email){
        $conn = $this->db->connect();
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
}