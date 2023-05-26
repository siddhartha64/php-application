
<?php

session_start();
if (($_SESSION['user_name']!=NULL)) {
    $servername = "localhost";
    $Username = "siddhu";
    $Password = "amma";
    $dbname = "userinfo";
    $conn = mysqli_connect($servername, $Username, $Password, $dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $stmt = $conn->prepare("SELECT Admin FROM USERS WHERE Username = ?");
    $stmt->bind_param("s", $_SESSION['user_name']);
    $stmt->execute();
    $stmt->bind_result($admin);
    $stmt->fetch();
    $stmt->close();

    if ($admin !== null) {
        
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
            
    <?php exit; ?>
    <?php
    }else{
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
        $loginuser=htmlspecialchars($_POST['Username']);
        $pass=htmlspecialchars($_POST['Password']);
        $s = $conn->prepare("SELECT * FROM USERS WHERE Username = ?");
        $s ->bind_param("s",$loginuser);
        $s->execute();
        
        
        
        $userdb = $s->get_result();
        $user=$userdb->fetch_assoc();
        
        
        if ($user['Password']==$_POST['Password']&& $user['Username']==$_POST['Username']) {
            echo "ifblock";
            $_SESSION['user_name'] = $_POST['Username'];
            setcookie('username', $username, time() + 86400, '/');

            header('Location: login.php');
            exit;
    }   else {
           
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
