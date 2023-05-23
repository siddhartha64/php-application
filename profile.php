<?php
session_start();
?>
<html>
<head>
<title>home page</title>
</head>
<body>
    <h1> welcome <?php echo $_SESSION['username']; ?> </h1>
                    

</body>
</html>
<?php 
if( isset($FILES['image'])){
    $file_name=$FILES['image']['name'];
    $file_size=$FILES['image']['size'];
    $file_tmp=$FILES['image']['temp_name'];
    $file_type=$FILES['image']['type'];
    if(move_uploaded_file($file_tmp,"img/$file_name" )){
        echo"sucessfully uploaded";
    }else{
        echo"could not upload the file";
    }
}
?>
<html>
    <body>
   
        <form action='' method="POST" enctype="multipart/form-data">
            <input type="file" name='image'/><br><br>
            <input type="submit"/>
        <form>
    <body>
<html>  