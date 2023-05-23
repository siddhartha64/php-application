
<?php

// Check if user is already logged in, redirect to another page



// Database connection parameters
$servername = "localhost";
$username = "siddhu";
$password = "amma";
$dbname = "userinfo";

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo '111';die("Connection failed: " . $conn->connect_error);
    }
    // Validate form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email   =  $_POST['email'];
    
    
       // Check if the username already exists in the database
    $stmt = $conn->prepare("SELECT * FROM USERS WHERE Username = '$username'");
    $stmt->execute();
    $result = $stmt->get_result();
   
    if ($result->num_rows > 0) {
     //   $stmt->close();
       // $conn->close();
        echo "Username already exists. Please choose a different username.";
        exit();
    }
   // $stmt->close();

    // Insert the new user into the database
   else{
    
    $reg = $conn->prepare("INSERT INTO USERS(Username, Password,Email) VALUES (?,?,?)");

    $reg->bind_param("sss",$username, $password,$email);
    $reg->execute();
    echo"11";
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