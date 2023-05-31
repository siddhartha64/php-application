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
    if (isset($_POST['submit'])) {
            $username = htmlspecialchars($_POST['Username']);
        
        if (isset($_POST['Admin'])){
            $admin="admin";
            echo"a";
        
            $sql =$conn->prepare( "UPDATE USERS SET  Admin = ? WHERE Username= ? ");
            $sql->bind_param("ss",$admin, $username);
            $sql->execute();
            echo"b";

            if  ($sql->execute()==True) {
                echo "User record updated successfully";
        } else {
                echo "Error updating user record: " . mysqli_error($conn);
    }} else{
            $null="NULL";
        $sq =$conn->prepare( "UPDATE USERS SET  Admin = ? WHERE Username= ? ");
            $sq->bind_param("ss",$null, $username);
            $sq->execute();
            echo"aaa";

            if  ($sq->execute()==True) {
                echo "User record updated successfully";
            } else {
                echo "Error updating user record: " . mysqli_error($conn);
    }}}



    $sql = ("SELECT * FROM USERS");
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);



    echo "<form method='post'>";
    echo "Username: <input type='text' name='Username' value='" . $row['Username'] . "'><br>";
    echo "Admin: <input type='checkbox' name='Admin' value='" . $row['Admin'] . "'><br>";
    echo "<input type='submit' name='submit' value='Update'><br>";
    echo "</form>";

    mysqli_close($conn);}
    ?>