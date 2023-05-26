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
        
    

        if (isset($_POST['submit'])) {
            
            $username =htmlspecialchars( $_POST['Username']);
            $password = htmlspecialchars($_POST['Password']);
            $email = htmlspecialchars($_POST['Email']);


            $sql = prepare("DELETE FROM USERS WHERE Username =?");
            $sql ->bind_param("s",$loginuser);
                $sql->execute();
                if($sql->execute()==True){
                echo "User record deleted successfully";
            } else {
                echo "Error updating USERS record: " . mysqli_error($conn);
            }
        }



        $sql = "SELECT * FROM USERS";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);



        echo "<form method='post'>";
       
        echo "Username: <input type='text' name='Username' value='" . $row['Username'] . "'><br>";
        echo "Password: <input type='password' name='Password' value='" . $row['Password'] . "'><br>";
        echo "Email: <input type='text' name='Email' value='" . $row['Email'] . "'><br>";
        echo "<input type='submit' name='submit' value='delete'>";
        echo "</form>";


        mysqli_close($conn);}}
        ?>
