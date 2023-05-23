<?php
session_start();
$servername = "localhost";
$Username = "siddhu";
$Password = "amma";
$dbname = "userinfo";
$conn = mysqli_connect($servername, $Username, $Password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['submit'])) {
    
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $email = $_POST['Email'];
    echo"a";
    
    $sql = "UPDATE USERS SET  Password='$password', Email='$email' WHERE Username='$username' ";
    echo"b";
    if (mysqli_query($conn, $sql)) {
        echo "User record updated successfully";
    } else {
        echo "Error updating user record: " . mysqli_error($conn);
    }
}



$sql = ("SELECT * FROM USERS");
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);



echo "<form method='post'>";
echo "<input type='hidden' name='id' value='" . $row['Id'] . "'>";
echo "Username: <input type='text' name='Username' value='" . $row['Username'] . "'><br>";
echo "Password: <input type='password' name='Password' value='" . $row['Password'] . "'><br>";
echo "Email: <input type='text' name='Email' value='" . $row['Email'] . "'><br>";
echo "<input type='submit' name='submit' value='Update'>";
echo "</form>";


mysqli_close($conn);
?>