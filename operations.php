<?php
   session_start();
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $dbname = 'lab5';
   $con = mysqli_connect( $dbhost, $dbuser, $dbpass, $dbname);
   
    if(! $con ) {
        echo 'Connected Failed';
        die('Could not connect: ' . mysqli_error($conn));
    }
    // echo 'Connected successfully1 <br>';

    if(isset($_POST['login_user'])){
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        
        // echo " name = $username and password = $password";
        $query= "SELECT '*' FROM users WHERE username = '$username' AND userpassword = '$password' ";
        $query_run= mysqli_query($con, $query);
        
        if(mysqli_num_rows($query_run) == 1){
            setcookie("name", $username, time()+60);
            $_SESSION['message'] = "login Successfully";
            header("Location: home.php");
            exit(0);
        }else{
            $_SESSION['message'] = "Invalid username or password";
            header("Location: login.php");
            exit(0);
        }
        
        
    }

    if(isset($_POST['signup_user'])){
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $conpassword = mysqli_real_escape_string($con, $_POST['conpassword']);
        
        
        $checkQuery = "SELECT username FROM users WHERE username = '$username'";
        $checkResult = mysqli_query($con, $checkQuery);
        if(mysqli_num_rows($checkResult) == 0 && $password == $conpassword){
            // echo "Db check is not zero";
            $query = "INSERT INTO users (username,userpassword) VALUES ('$username','$password')";
            $query_run = mysqli_query($con, $query);
        }
        
        
        if($query_run){
            $_SESSION['message'] = "Sign up Successfully";
            header("Location: login.php");
            exit(0);
        }else{
            $_SESSION['message'] = "Invalid username or password";
            header("Location: signup.php");
            exit(0);
        }
    }

    if(isset($_POST['logout_user'])){
        header("Location: index.php");
        // session_destroy();
        // setcookie("PHPSESSID", session_id(), time()-1);
        // // setcookie(session_id(),time()-1);
        
        // exit(0);
        
        // Destroy all the session variables.
        $_SESSION = array();
        
        // delete the session cookie also to destroy the session
        if (ini_get("session.use_cookies")) {
            $cookieParam = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $cookieParam["path"], $cookieParam["domain"], $cookieParam["secure"], $cookieParam["httponly"]);
        }
        
        setcookie("name", $username, time()-1);
        // as a last step, destroy the session.
        session_destroy();
    }
    
//  echo 'Connected successfully';
// mysqli_close($conn);

?>

<?php
    if(isset($_SESSION['message'])) :
?>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Operation Status:  </strong> <?= $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php 
    unset($_SESSION['message']);
    endif;
?>