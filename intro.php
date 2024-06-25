<?php
include 'connection.php';

$err = '';
$error = array();

if (isset($_POST['submit'])) {
        if (empty($_POST['input_task'])) {

                $err = "Fill in the blank field with a task";
        } else {
                $user_id = $_SESSION['user_id'];
                $todo = mysqli_real_escape_string($db_conn2, $_POST['input_task']);
                $mysql = "INSERT INTO todos (task, user_id) VALUES ('$todo', $user_id)";
                $todoRes = mysqli_query($db_conn2, $mysql);
                if ($todoRes){
                        header('Location: todo.php');
                        exit();
                    } else {
                        $err = "Error adding task: " . mysqli_error($db_conn2);
                    } 
        }
}

if (isset($_POST['delete'])) {
        $del = $_POST['id'];
        $mysqldel = "DELETE FROM todos WHERE id = $del";
        mysqli_query($db_conn2, $mysqldel);
        header('location: todo.php');
}
//when 'edit' button is clicked, you have access to the id and the task
if (isset($_POST['edit'])) {
        //*coming from the hidden input fields
        $id = $_POST['id'];
        $task = $_POST['task'];

        //*URL query parameter; passes strings through URL
        header('location: todo.php?id="' . $id . '"&task="' . $task . '"');
}

if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $task = $_POST['input_task'];

        $mysqlUpdate = "UPDATE todos SET task = '" . $task . "' WHERE id = '" . $id . "' ";
        mysqli_query($db_conn2, $mysqlUpdate);

        header('location: todo.php');
}

if(isset($_POST['login'])){
        $username = mysqli_real_escape_string ($db_conn2, $_POST['username']);
        $password = mysqli_real_escape_string  ($db_conn2, $_POST['password']);
    
        if (empty($username)) { 
            array_push($error, "Username is required"); 
        }
        if(empty($password)){
            array_push($error, "Enter your password ");
        }
    
        if (count($error) == 0) {
        // Assuming you have a hashed password in the database
        $pswrdhash = password_hash($password, PASSWORD_DEFAULT);
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($db_conn2, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: todo.php');
                exit();
            } else {
                array_push($error, "Credentials mismatch");
            }
    }

     // Store errors in session and redirect back to login page
     $_SESSION['error'] = $error;
     header('Location: login.php');
     exit();
}

if (isset($_POST['register'])){
        $fullname = mysqli_real_escape_string ($db_conn2, $_POST['full_name']);
        $email = mysqli_real_escape_string  ($db_conn2, $_POST['email']);
        $username = mysqli_real_escape_string ($db_conn2, $_POST['username']);
        $password = mysqli_real_escape_string  ($db_conn2, $_POST['password']);
        $confirmpassword = mysqli_real_escape_string  ($db_conn2, $_POST['confirm_password']);

        if (empty($username)) { 
            array_push($error, "Username is required"); 
        }
        if(empty($email)){
            array_push($error, "Email is required");
        }
        if(empty($password)){
            array_push($error, "Enter a password");
        }
        if($password != $confirmpassword){
            array_push($error, "Passwords mismatch");
        }
        
 
    $sql = "SELECT * FROM users WHERE username= '$username' OR email= '$email'";
    $sqlquery = mysqli_query($db_conn2, $sql);
    $count_user_email = mysqli_fetch_assoc($sqlquery);

    if($count_user_email){
        if($count_user_email['username'] == $username){
            array_push($error, "Username already exists");
        }
        if($count_user_email['email'] == $email){
            array_push($error, "Email already exists");
        }
    }

    if(count($error) == 0){
      $pswrdhash = password_hash($password, PASSWORD_DEFAULT);
      $mysql = "INSERT INTO users (fullname, email, username, password) VALUES ( '$fullname', '$email', '$username', '$pswrdhash')";
      $mysqlquery = mysqli_query($db_conn2, $mysql);

        if ($mysqlquery) {
                $_SESSION['message'] = "Registration Successful";
                header('Location: login.php');
                exit();
        } else {
                array_push($error, "Registration failed, please try again.");
        }
    }

    $_SESSION['error'] = $error;
    header('Location: signup.php');
    exit();
    
}