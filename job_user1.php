<?php
    $servername="localhost";
    $username="root";
    $password="";
    $database="jobadmin";

    $conn=mysqli_connect($servername,$username,$password,$database);
    if(!$conn){
        die("connection failed".mysqli_connect(error));
    }
    /*else{
        echo "connection succesful";
    }*/

    if($_SERVER['REQUEST_METHOD']=='POST'){
      $title= $_POST["title"];
      $experience= $_POST["experience"];
    $sql="INSERT INTO jobadmin (title, experience) VALUES ('$title', '$experience')";
    
    $result= mysqli_query($conn, $sql);
    if($result){
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'><strong>!!!!!</strong>JOB HAS BEEN ADDED.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
    else{
      echo "not inserted".mysqli_error($conn);

    }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    <style>
        body {
            background-color: #ffc0cb;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        #myTable {
            width: 100%;
        }
    </style>

    <title>USER PORTAL</title>
    <link rel="icon" type="image/png" href="C:\Users\adity\OneDrive\Desktop\faviconn.png">
    <meta charset="utf-8">
  </head>
  <body>
  <div class="modal fade" id="editModal" tabindex="-1" role=" dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Upload your Resume</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="upload.php" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <input type="hidden" name="snoEdit" id="snoEdit">
        <div class="mb-3">
    <label for="title" class="form-label">Job Description</label>
    <textarea readonly>sample text</textarea>
</div>

  <div class="mb-3">
            <input type="file" class="form-control" id="file" name="file">
  </div>
  <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
    </div>
  </div>
</div>
  
<div class="container my-5">
    
    <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Jobs Available</th>
      <th scope="col">Experience</th>
      <th scope="col">Apply</th>
    </tr>
  </thead>
  <tbody>
  <?php
  

$sql="SELECT * FROM jobadmin";
$result=mysqli_query($conn,$sql);
$sno=0;
while($row= mysqli_fetch_assoc($result))
{
  $sno=$sno+1;
  echo "<tr>
  <th scope='row'>".$sno."</th>
  <td>".$row['title']."</td>
  <td>".$row['experience']."</td>
  <td> <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editModal'><font color='white'>Apply</font></button></td>
  </tr>";
}
?>
  </tbody>
</table>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    -->
    <link rel="stylesheet" type="text/css" href="styles.css">
    <div class="center">
    <table id="example" class="display" style="width:100%">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    </table>
</div>
  </body>
</html>