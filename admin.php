<?php
session_start();
if($_SESSION['user_name']!=NULL){
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
            echo "<td>    <a href='update.php?'>Update</a> | <a href='delete.php?'>Delete</a> | <a href= 'setadmins.php?'> admin</a></td>";
            echo "</tr>";
        }

        echo "</table>";
        echo" <a href='logout.php'>logout</a>";

        mysqli_close($conn);}}
        ?>
