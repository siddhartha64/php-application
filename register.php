


<?php


$servername = "localhost";
$username = "siddhu";
$password = "amma";
$dbname = "userinfo";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo '111';die("Connection failed: " . $conn->connect_error);
    }
   
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email   =  htmlspecialchars($_POST['email']);
    
    
      
    $stmt = $conn->prepare("SELECT * FROM USERS WHERE Username = ?");
    $stmt ->bind_param("s",$username);
    
    $stmt->execute();

    $result = $stmt->get_result();
   
    if ($result->num_rows > 0) {
     
        echo "Username already exists. Please choose a different username.";
        exit();
    }
   
   else{
    
    $reg = $conn->prepare("INSERT INTO USERS(Username, Password,Email) VALUES (?,?,?)");

    $reg->bind_param("sss",$username, $password,$email);
    $reg->execute();
   
    if($reg->execute()==True){
    header("Location: login.php");
    exit();}
    else{
        echo "Error: "  ;
    }
   }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
</head>
<body>
    <h1>Registration Page</h1>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="email">email:</label>
        <input type="email" name="email" required><br>

        
       
       
       
        <input type="submit" value="Register">
    </form>
</body>
</html>
