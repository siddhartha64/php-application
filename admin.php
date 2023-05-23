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


$sql = "SELECT * FROM USERS";
$result = mysqli_query($conn, $sql);
echo "a";

echo "<table>";
echo "<tr><th>Username</th><th>Password</th><th>Email</th><th>Action</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    
    echo "<td>" . $row['Username'] . "</td>";
    echo "<td>" . $row['Password'] . "</td>";
    echo "<td>" . $row['Email'] . "</td>";
    echo "<td><a href='update.php?'>Update</a> | <a href='delete.php?'>Delete</a></td>";
    echo "</tr>";
}
echo "</table>";


mysqli_close($conn);
?>