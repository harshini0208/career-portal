<?php

$servername="localhost";
$username="root";
$password="";
$database="jobadmin";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn)
{
    die("connection unsuccessful".mysqli_connect_error()); 
}

$email=$_POST['email'];

if(isset($_POST['submit']))
{
$filename=$_FILES['file']['name'];
$tempfilename=$_FILES['file']['tmp_name'];
$folder="uploads/".$filename;

$sql="INSERT INTO `upload` (`filename`) VALUES ('$filename')";

if($filename=="")
{
    echo "<div class='alert alert-warning' role='alert'>Please upload a file</div>";
}
else
{
$filesplit=explode('.',$filename);
$filext=strtolower(end($filesplit));
$allowed=array('pdf');
if(in_array($filext,$allowed))
{
    $result=mysqli_query($conn,$sql);
    move_uploaded_file($tempfilename,$folder); 
    echo "<div class='alert alert-success' role='alert'>File Uploaded</div>";
}
else
{
   echo " <div class='alert alert-danger' role='alert'>only pdf accepted</div>";
}
}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    
    <title>FILE UPLOAD</title>
  </head>
  <body>


    
    <style>
        /* CSS for styling */
        body {
            font-family: Arial, sans-serif;
        }
        textarea {
            width: 90%;
            height: 200px;
            padding: 10px;
            margin: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none; /* Prevents resizing of the textarea */
        }
    </style>


</html>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
