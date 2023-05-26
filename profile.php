<?php
session_start();
if($_SESSION['user_name']!=NULL){
    ?>

    <html>
    <head>
    <title>home page</title>
    </head>
    <body>
        <h1> welcome <?php echo $_SESSION['user_name']; ?> </h1>
        <a href="logout.php">logout</a>
        <form action='' method="POST" enctype="multipart/form-data">
                <input type="file" name='image'/><br><br>
                <input type="submit"/>               

    </body>
    </html>
    <?php 
    $targetlocation="uploads/";
    $allowedExtensions = array("jpg", "jpeg", "png", "pdf"); 
    $maxFileSize = 5 * 1024 * 1024;
    if( isset($FILES['image'])){
        $file_name=$FILES['image']['name'];
        $file_size=$FILES['image']['size'];
        $file_tmp=$FILES['image']['temp_name'];
        $file_type=$FILES['image']['type'];
        $file_Extension = (pathinfo($FILES, PATHINFO_EXTENSION));
        $path=$targetlocation.$file_name;
        if ($maxFileSize > $file_size){
            if (in_array($file_Extension, $allowedExtensions)){
                if(move_uploaded_file($file_tmp,$path )){
                    echo"sucessfully uploaded";}
        }  }     else{
                    echo"could not upload the file";}
    }
    
}?>
