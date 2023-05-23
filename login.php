<?php

session_start();
if (isset($_SESSION['user_name'])) {
   
    if($_SESSION['user_name']=='user'){
        ?>
        
    <!DOCTYPE html>   
    <html>  
    </body>
        <form>
            <a href="admin.php"> Users info</a><br>
            <a href="profile.php">Profile</a><br>
            <a href="logout.php">logout</a>
        </form>
    </body>     
    </html>
        <?php
   exit;
    }
    else{
        header('Location: profile.php');
        exit; 
    }
}
else{
    $conn = new mysqli("localhost","siddhu","amma","userinfo");
    if ($conn->connect_error){
        echo "Some";
        die("connection failed: ".$conn->error);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $loginuser=$_POST['Username'];
        $pass=$_POST['Password'];
        $s = $conn->prepare("SELECT * FROM USERS WHERE Username = '$loginuser'");
        $s->execute();
        
        $userdb = $s->get_result();
        $user=$userdb->fetch_assoc();
        echo "123";
        
        if ($user['Password']=$_POST['Password']&& $user['Username']=$_POST['Username']) {
            echo "123";
            $_SESSION['user_name'] = $_POST['Username'];
            setcookie('username', $username, time() + 86400, '/');

            header('Location: login.php');
            exit;
        } else {
           
            $error = 'Invalid username or password';
        }
    }
    }
        ?>
   

<!DOCTYPE html>   
<html>   
<head>  
<title> Login Page </title>    
</head>    
<body>    
    <center> <h1> Student Login Form </h1> </center>   
    <form method="POST">  
      
            <label>Username : </label>
            <input type="text" placeholder="Enter Username" name="Username" required><br>
            <label>Password : </label>
            <input type="password" placeholder="Enter Password" name="Password" required><br>  
            <button type="submit">Login</button><br>   
           
         
    </form> 
    <a href="register.php">Register</a>
   
</body>     
</html>